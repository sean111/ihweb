<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Log;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    public function index()
    {
        $this->addBreadcrumb('Admins', null, 'group');
        $admins = User::where('role', '!=', 'user')->get();
        return $this->view('admin.admins.index', ['admins' => $admins]);
    }

    public function edit(int $id = 0)
    {
        if ($id > 0) {
            $admin = User::find($id);
        } else {
            $admin = new User;
        }
        $orgs = getOrgs();
        clock()->info($orgs);
        return $this->view('admin.admins.edit', ['admin' => $admin, 'orgs' => $orgs]);
    }

    public function delete(int $id)
    {
        try {
            $admin = User::findOrFail($id);
        } catch (\Throwable $e) {
            Log::exception($e);
        }
    }
}