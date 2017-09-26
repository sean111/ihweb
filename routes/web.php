<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', 'SecurityController@showLogin')->name('login');
Route::post('/check_login', 'SecurityController@checkLogin')->name('check_login');
Route::get('/logout', 'SecurityController@logout')->name('logout');
