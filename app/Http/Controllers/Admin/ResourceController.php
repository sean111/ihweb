<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Http\Request;
use Log;
use Storage;

class ResourceController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    public function index()
    {
        $org = getDefaultOrg();
        $files = Resource::where('organization_id', '=', $org->id)->get();
        $categories = Category::where('organization_id', '=', $org->id)->get();
        clock($files);
        return $this->view('admin.resources.index', compact('files', 'categories'));
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('resource')) {
            try {
                $org = getDefaultOrg();
                $name = $request->get('name');
                $file = $request->file('resource')->store($org->id . '/resources', 's3');
                $size = Storage::disk('s3')->size($file);
                clock([$name, $file, $size]);
                Resource::create(['name' => $name, 'path' => $file, 'size' => $size, 'organization_id' => $org->id]);
                setAlert('success', 'The resource was saved successfully');
                return redirect(route('admin.resources'));
            } catch (\Throwable $e) {
                Log::exception($e);
                setAlert('error', 'There was an error when saving the resource');
            }
        }
        return $this->view('admin.resources.upload');
    }

    public function rename(Request $request)
    {
        try {
            if (empty($request->get('name'))) {
                throw new \InvalidArgumentException('Empty name');
            }
            $resource = Resource::findOrFail($request->get('file_id'));
            $resource->name = $request->get('name');
            $resource->save();
            setAlert('success', 'The resource has been renamed');
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', 'There was an error renaming that resource');
        }
        return redirect(route('admin.resources'));
    }

    public function assign(Request $request)
    {
        try {
            if (empty($request->get('category'))) {
                throw new \InvalidArgumentException('Empty category');
            }
            $resource = Resource::findOrFail($request->get('file_id'));
            $resource->category_id = $request->get('category');
            $resource->save();
            setAlert('success', 'The resource has been assigned');
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', 'There was an error assigning that resource');
        }
        return redirect(route('admin.resources'));
    }

    public function delete(int $id)
    {
        try {
            $resource = Resource::findOrFail($id);
            $resource->path;
            Storage::disk('s3')->delete($resource->path);
            $resource->delete();
            setAlert('success', 'The resource was deleted');
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', 'There was an error deleting the resource');
        }
        return redirect(route('admin.resources'));
    }
}