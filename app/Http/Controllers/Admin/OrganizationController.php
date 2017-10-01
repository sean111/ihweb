<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    public function index()
    {
        $this->addBreadcrumb('Organizatons', null, 'building');
        $orgs = Organization::all();
        return $this->view('admin.orgs.index', ['orgs' => $orgs]);
    }

    public function edit(int $id = 0)
    {
        if ($id > 0) {
            $org = Organization::findOrFail($id);
        } else {
            $org = new Organization;
        }
        return $this->view('admin.orgs.edit', ['org' => $org, 'id' => $id]);
    }

    public function save(Request $request)
    {
        try {
            $org = Organization::findOrNew($request->get('id'));
            $org->name = $request->get('name');
            $org->email = $request->get('email');
            $org->domain = $request->get('domain');
            $org->save();
            set_alert('success', 'Organization has been saved');
        } catch (\Throwable $e) {
            set_alert('error', $e->getMessage());
        }
        return redirect(route('admin.orgs'));
    }

    public function delete(int $id)
    {
        try {
            $org = Organization::findOrFail($id);
            $org->delete();
            set_alert('success', 'Organization deleted');
        } catch (\Throwable $e) {
            set_alert('error', $e->getMessage());
        }
        return redirect(route('admin.orgs'));
    }
}