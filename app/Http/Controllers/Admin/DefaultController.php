<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Response;

class DefaultController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    public function index()
    {
        return $this->view('admin.index');
    }

    public function changeOrg(int $org) {
        setDefaultOrg($org);
        return Redirect::back();
    }

    public function branding()
    {
//        return $this->view('admin.branding', ['organization' => getDefaultOrg()])->header('Content-Type', 'text/css');
        return Response::view('admin.branding', ['organization' => getDefaultOrg()])->header('Content-Type', 'text/css');
    }
}