<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Frequency;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Log;

class ScheduleController extends Controller
{
    public $org;
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
            $events = Schedule::where('organization_id', '=', $org->id)->get();
            clock()->debug($events);
            return $this->view('admin.schedule.index', ['events' => $events]);
        } catch (\Throwable $e) {
            Log::exception($e);
            setAlert('error', 'There was an error retrieving the schedules');
            return redirect(route('admin.home'));
        }
    }

    public function edit(int $id = 0)
    {
        try {
            $org = getDefaultOrg();
            $event = Schedule::findOrNew($id);
            clock()->debug($event);
            $categories = Category::where('organization_id', '=', $org->id)->get();
            clock()->debug($categories);
            $frequencies = Frequency::toArray();
            clock()->debug($frequencies);
            return $this->view('admin.schedule.edit', compact('event', 'categories', 'id', 'frequencies'));
        } catch (\Throwable $e) {
            clock()->error($e->getMessage());
            Log::exception($e);
            setAlert('error', 'There was an error when trying to retrieve that schedule');
            return redirect(route('admin.schedules'));
        }
    }

    public function save(Request $request)
    {
        try {
            $schedule = Schedule::findOrNew($request->get('id'));
            $schedule->category_id = $request->get('category');
            $frequency = $request->get('frequency');
            $schedule->frequency = $frequency;
            $schedule->organization_id = getDefaultOrg()->id;
            if ($frequency === 'once') {
                $schedule->start = $request->get('date');
                $schedule->end = $request->get('date');
            } else {
                $schedule->start = $request->get('start');
                $schedule->end = $request->get('end');
                $schedule->days = \serialize($request->get('day'));
            }
            $schedule->time = $request->get('time');
            $schedule->save();
        } catch (\Throwable $e) {
            clock()->error($e->getMessage());
            Log::exception($e);
            setAlert('error', 'There was an error when trying to save the schedule');
        }
        return redirect(route('admin.schedules'));
    }

    public function delete(int $id)
    {
        try {
            $schedule = Schedule::findOrFail($id);
            $schedule->delete();
        } catch (\Throwable $e) {
            clock()->error($e->getMessage());
            Log::exception($e);
            setAlert('error', 'There was an error when trying to delete the schedule');
        }
        return redirect(route('admin.schedules'));
    }
}