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
    Route::group(['prefix' => 'organization'], function() {
        Route::get('/', 'API\OrganizationController@index')->name('api.organization');
        Route::get('id/{id}', 'API\OrganizationController@getById')->name('api.organization.byid');
        Route::get('domain/{domain}', 'API\OrganizationController@getByDomain')->name('api.organization.bydomain');

    });
});
