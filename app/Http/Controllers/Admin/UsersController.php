<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Group;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    public function index()
    {
        $org = getDefaultOrg();
        \Debugbar::info($org);
        $this->addBreadcrumb('Users', null, 'users');
        $users = User::where('organization_id', '=', $org->id)->where('role', '=', 'user')->get();
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
        $org = getDefaultOrg();
        $groups = Group::where('organization_id', '=', $org->id)->get();
        return $this->view('admin.users.edit', compact('user', 'id', 'groups'));
    }

    public function save(Request $request)
    {
        try {
            $user = User::findOrNew($request->get('id'));
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email');
            $user->firebase_uid = $request->get('firebase_uid');
            $user->group = $request->get('group');
            $user->save();
            setAlert('success', 'User has been saved');
        } catch (\Throwable $e) {
            setAlert('error', $e->getMessage());
        }
        return redirect(route('admin.users'));
    }

    public function delete(int $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            setAlert('success', 'User has been deleted');
        } catch (\Throwable $e) {
            setAlert('error', $e->getMessage());
        }
        return redirect(route('admin.users'));
    }
}