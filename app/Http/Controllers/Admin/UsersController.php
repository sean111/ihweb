<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    public function index()
    {
        $this->addBreadcrumb('Users', null, 'users');
        $users = User::all();
        return $this->view('admin.users.index', ['users' => $users]);
    }

    public function edit(int $id = 0)
    {
        $this->addBreadcrumb('Users', 'admin.users', 'users');
        if ($id !== 0) {
            $user = User::findOrFail($id);
            $this->addBreadcrumb('Edit', null, 'edit');
        } else {
            $user = new User;
            $this->addBreadcrumb('New', null, 'plus');
        }
        return $this->view('admin.users.edit', ['user' => $user, 'id' => $id]);
    }

    public function save(Request $request)
    {
        try {
            $user = User::findOrNew($request->get('id'));
            $user->update($request->all());
            $user->save();
            set_alert('success', 'User has been saved');
        } catch (\Throwable $e) {
            set_alert('error', $e->getMessage());
        }
        return redirect(route('admin.users'));
    }
}