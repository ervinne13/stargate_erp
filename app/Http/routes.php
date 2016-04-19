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

Route::group(['prefix' => 'administration', 'middleware' => ['auth']], function () {
    Route::get('/', 'Administration\AdministrationController@index');

    //  Users
    Route::get('users/datatable', 'Administration\UsersController@datatable');
    Route::resource('users/{id}/settings', 'Administration\UsersController@settings');
    Route::resource('users', 'Administration\UsersController');

    //  Modules
    Route::get('modules/datatable', 'Administration\ModulesController@datatable');
    Route::resource('modules', 'Administration\ModulesController');

    Route::get('no-series/datatable', 'Administration\NumberSeriesController@datatable');
    Route::resource('no-series', 'Administration\NumberSeriesController');
});

Route::group(['prefix' => 'financial-management', 'middleware' => ['auth']], function () {
    Route::get('/', 'FinancialManagement\FinancialManagementController@index');
});
