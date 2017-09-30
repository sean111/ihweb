<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function __construct()
    {
        $this->addBreadcrumb('Dashboard', 'admin.home', 'tachometer');
    }

    public function index()
    {
        $this->addBreadcrumb('Test');
        return $this->view('admin.index');
    }
}