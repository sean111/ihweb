<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Log;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $org = getDefaultOrg();
            $events = Schedule::where('organization_id', '=', $org->id);
            return $this->view('admin.schedule.index', ['events' => $events]);
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', 'There was an error retrieving the schedules');
            return redirect(route('admin.home'));
        }
    }

    public function edit(int $id = 0)
    {

    }

    public function save(Request $request)
    {

    }

    public function delete(int $id)
    {

    }
}