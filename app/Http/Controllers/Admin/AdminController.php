<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

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
}