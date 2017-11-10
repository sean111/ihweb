<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

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
}