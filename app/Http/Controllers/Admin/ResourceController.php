<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        clock($files);
        return $this->view('admin.resources.index', compact('files'));
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
}