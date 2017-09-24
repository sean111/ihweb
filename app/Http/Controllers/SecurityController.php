<?php

namespace App\Http\Controllers;

class SecurityController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
}