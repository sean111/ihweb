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
        Route::get('/{userId}', 'API\UserController@get')->name('api.user.get');
        Route::post('update', 'API\UserController@update')->name('api.user.update');
    });
    Route::group(['prefix' => 'organization'], function() {
        Route::get('/', 'API\OrganizationController@index')->name('api.organization');
        Route::get('id/{id}', 'API\OrganizationController@getById')->name('api.organization.byid');
        Route::get('domain/{domain}', 'API\OrganizationController@getByDomain')->name('api.organization.bydomain');
        Route::get('/categories', 'API\OrganizationController@categories')->name('api.org.categories');
        Route::get('{orgId}/categories', 'API\OrganizationController@categoriesById')->name('api.org.categories.id');
        Route::get('/groups', 'API\OrganizationController@groups')->name('api.org.categories');
        Route::get('{orgId}/groups', 'API\OrganizationController@groupsById')->name('api.org.categories.id');
        Route::post('/', 'API\OrganizationController@create')->name('api.organization.new');
        Route::post('/{id}', 'API\OrganizationController@update')->name('api.organization.update');
    });
    Route::group(['prefix' => 'question'], function() {
        Route::get('{catId}', 'API\QuestionController@getAll')->name('api.question.all');
        Route::get('{catId}/diff/{diff}', 'API\QuestionController@getDifficulty')->name('api.question.difficuly');
        Route::get('{catId}/rand', 'API\QuestionController@getRandom')->name('api.question.rand');
        Route::get('{catId}/{count}/{start?}', 'API\QuestionController@getRange')->name('api.question.range');
    });
    Route::group(['prefix' => 'media'], function() {
        Route::get('{id}', 'API\ResourceController@get')->name('api.media');
    });
});
