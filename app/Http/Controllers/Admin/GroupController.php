<?php

namespace App\Http\Controllers\Admin;

use Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Log;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    public function index()
    {
        $org = getDefaultOrg();
        $groups = Group::where('organization_id', '=', $org->id)->get();
        return $this->view('admin.groups.index', compact('groups'));
    }

    public function edit(int $id = 0)
    {
        if ($id) {
            $org = getDefaultOrg();
            $group = Group::where('id', '=', $id)->where('organization_id', '=', $org->id)->first();
        } else {
            $group = new Group;
        }
        \Debugbar::info($group);
        return $this->view('admin.groups.edit', compact('group', 'id'));
    }

    public function save(Request $request)
    {
        try {
            $org = getDefaultOrg();
            $group = Group::findOrNew($request->get('id'));
            $group->name = $request->get('name');
            $group->organization_id = $org->id;
            $group->save();
            if ($group->code === null) {
                $code = base_convert($group->id . microtime(true), 10, 31);
                $group->code = $code;
                $group->save();
            }
            setAlert('success', 'Group saved successfully');
        } catch (\Throwable $e) {
            setAlert('error', 'There was an error saving the group');
            Log::exception($e);
        }
        return redirect(route('admin.groups'));
    }

    public function delete(int $id = 0)
    {
        try {
            $org = getDefaultOrg();
            $group = Group::where('id', '=', $id)->where('organization_id', '=', $org->id)->first();
            $group->delete();
            setAlert('success', 'The group has been deleted');
        } catch (\Throwable $e) {
            setAlert('error', 'There was an error deleting the group');
            Log::exception($e);
        }
        return redirect(route('admin.groups'));
    }
}
