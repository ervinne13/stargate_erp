<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::post('user/create', 'Auth\AuthController@create');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/dashboard', 'DashboardController');

Route::get('/administration', 'AdministrationController@index');
Route::get('/administration/users/datatable/{testType}', 'Administration\UsersController@datatable');
Route::get('/administration/users/datatable', 'Administration\UsersController@datatable');
Route::resource('/administration/users', 'Administration\UsersController');
