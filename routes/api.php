<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth.firebase'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'API\UserController@index')->name('api.user');
        Route::post('update', 'API\UserController@update')->name('api.user.update');
    });
});
