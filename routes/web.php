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
})->name('home');
Route::get('/login', 'SecurityController@showLogin')->name('login');
Route::post('/check_login', 'SecurityController@checkLogin')->name('check_login');
Route::get('/logout', 'SecurityController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'is.admin'], 'prefix' => 'admin'], function() {
    Route::get('/', 'Admin\DefaultController@index')->name('admin.home');
    //Users
    Route::get('/users', 'Admin\UsersController@index')->name('admin.users');
    Route::group(['prefix' => 'user'], function() {
        Route::get('new', 'Admin\UsersController@edit')->name('admin.user.new');
        Route::get('edit/{id}', 'Admin\UsersController@edit')->name('admin.user.edit');
        Route::post('save', 'Admin\UsersController@save')->name('admin.user.save');
    });
});