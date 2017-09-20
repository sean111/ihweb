<?php
Route::middleware('auth', function() {
    Route::get('/', function() {
        return view('welcome');
    });
});