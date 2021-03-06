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
    Route::get('branding', 'Admin\DefaultController@branding')->name('admin.branding');
    Route::get('/', 'Admin\DefaultController@index')->name('admin.home');
    Route::get('switch/{org}', 'Admin\DefaultController@changeOrg')->name('admin.switch.org');
    //Users
    Route::get('/users', 'Admin\UsersController@index')->name('admin.users');
    Route::group(['prefix' => 'user'], function() {
        Route::get('new', 'Admin\UsersController@edit')->name('admin.user.new');
        Route::get('edit/{id}', 'Admin\UsersController@edit')->name('admin.user.edit');
        Route::post('save', 'Admin\UsersController@save')->name('admin.user.save');
        Route::get('delete/{id}', 'Admin\UsersController@delete')->name('admin.user.delete');
    });

    //Organizations
    Route::get('organizations', 'Admin\OrganizationController@index')->name('admin.orgs');
    Route::group(['prefix' => 'organization'], function() {
        Route::get('new', 'Admin\OrganizationController@edit')->name('admin.org.new');
        Route::get('edit/{id}', 'Admin\OrganizationController@edit')->name('admin.org.edit');
        Route::post('save', 'Admin\OrganizationController@save')->name('admin.org.save');
        Route::get('delete/{id}', 'Admin\OrganizationController@delete')->name('admin.org.delete');
    });

    //Admins
    Route::get('admins', 'Admin\AdminController@index')->name('admin.admins');
    Route::group(['prefix' => 'admin'], function() {
        Route::get('edit/{id}', 'Admin\AdminController@edit')->name('admin.admins.edit');
        Route::get('new', 'Admin\AdminController@edit')->name('admin.admins.new');
        Route::get('delete/{id}', 'Admin\AdminController@delete')->name('admin.admins.delete');
    });

    //Categories
    Route::get('categories', 'Admin\CategoriesController@index')->name('admin.categories');
    Route::group(['prefix' => 'category'], function() {
        Route::get('edit/{id}', 'Admin\CategoriesController@edit')->name('admin.category.edit');
        Route::get('new', 'Admin\CategoriesController@edit')->name('admin.category.new');
        Route::post('save', 'Admin\CategoriesController@save')->name('admin.category.save');
        Route::get('delete/{id}', 'Admin\CategoriesController@delete')->name('admin.category.delete');
    });

    //Questions
    Route::get('questions', 'Admin\QuestionController@index')->name('admin.questions');
    Route::group(['prefix' => 'question'], function() {
        Route::get('edit/{id}', 'Admin\QuestionController@edit')->name('admin.question.edit');
        Route::get('new', 'Admin\QuestionController@edit')->name('admin.question.new');
        Route::post('save', 'Admin\QuestionController@save')->name('admin.question.save');
        Route::get('delete/{id}', 'Admin\QuestionController@delete')->name('admin.question.delete');
    });

    //Groups
    Route::get('groups', 'Admin\GroupController@index')->name('admin.groups');
    Route::group(['prefix' => 'group'], function() {
        Route::get('edit/{id}', 'Admin\GroupController@edit')->name('admin.group.edit');
        Route::get('new', 'Admin\GroupController@edit')->name('admin.group.new');
        Route::post('save', 'Admin\GroupController@save')->name('admin.group.save');
        Route::get('delete/{id}', 'Admin\GroupController@delete')->name('admin.group.delete');
    });

    Route::get('resources', 'Admin\ResourceController@index')->name('admin.resources');
    Route::group(['prefix' => 'resource'], function() {
        Route::any('upload', 'Admin\ResourceController@upload')->name('admin.resource.upload');
        Route::post('rename', 'Admin\ResourceController@rename')->name('admin.resource.rename');
        Route::post('assign', 'Admin\ResourceController@assign')->name('admin.resource.assign');
        Route::get('delete/{id}', 'Admin\ResourceController@delete')->name('admin.resource.delete');
    });

    Route::get('schedules', 'Admin\ScheduleController@index')->name('admin.schedules');
    Route::group(['prefix' => 'schedule'], function() {
        Route::get('edit/{id}', 'Admin\ScheduleController@edit')->name('admin.schedule.edit');
        Route::get('new', 'Admin\ScheduleController@edit')->name('admin.schedule.new');
        Route::post('save', 'Admin\ScheduleController@save')->name('admin.schedule.save');
        Route::get('delete/{id}', 'Admin\ScheduleController@delete')->name('admin.schedule.delete');
    });
});