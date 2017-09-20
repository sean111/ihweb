<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 9/20/17
 * Time: 2:05 PM
 */

namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLogin()
    {
        //Show the admin login form
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}