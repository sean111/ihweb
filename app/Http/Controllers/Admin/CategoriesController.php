<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Log;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    /**
     * Lists all the categories for the admins default organization
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->addBreadcrumb('Categories', null, 'circle-o-notch');
        $org = getDefaultOrg();
        $categories = Category::where('organization_id', '=', $org->id)->get();
        return $this->view('admin.categories.index', ['categories' => $categories]);
    }

    public function edit(int $id = 0)
    {
        try {
            if ($id) {
                $category = Category::findOrFail($id);

            } else {
                $category = new Category;
            }
            $org = getDefaultOrg();
            $categories = Category::where('organization_id', '=', $org->id)->get();
            return $this->view('admin.categories.edit', ['category' => $category, 'id' => $id, 'categories' => $categories]);
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', $e->getMessage());
            return redirect(route('admin.categories'));
        }
    }

    public function save(Request $request)
    {
        try {
            if (empty($request->get('name'))) {
                throw new \InvalidArgumentException('Missing name field');
            }

            if ($id = $request->get('id')) {
                $category = Category::findOrFail($id);
            } else {
                $category = new Category;
            }

            $category->name = $request->get('name');
            $category->description = $request->get('description');
            $category->parent_id = $request->get('parent') > 0 ? $request->get('parent') : null;
            $category->save();
            setAlert('success', 'The category was saved successfully');
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', $e->getMessage());
        }
        return redirect(route('admin.categories'));
    }


    public function delete(int $id)
    {

    }
}