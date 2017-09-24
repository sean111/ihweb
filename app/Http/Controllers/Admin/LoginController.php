<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';
    protected $loginPath = '/admin/login';

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLogin()
    {
        return view('admin-login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}