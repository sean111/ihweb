<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer')->addBreadcrumb('Users', null, 'users');
    }

    public function index()
    {
        $users = User::all();
        return $this->view('admin.users.index', ['users' => $users]);
    }

    public function edit(int $id = 0)
    {
        dump($id);
        die;
    }
}