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
Route::get('logout', 'Auth\AuthController@logout');

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::resource('/dashboard', 'DashboardController');

Route::group(['prefix' => 'test'], function() {
    Route::get('ift', 'Test\InlineFormTablesController@index');
    Route::get('ift/datatable', 'Test\InlineFormTablesController@datatable');
});

Route::group(['prefix' => 'administration', 'middleware' => ['auth']], function () {
    Route::get('/', 'Administration\AdministrationController@index');

    //  Users
    Route::put('users/inactive', 'Administration\UsersController@deactivate');
    Route::put('users/active', 'Administration\UsersController@activate');
    Route::get('users/datatable', 'Administration\UsersController@datatable');
    Route::get('users/{id}/settings', 'Administration\UsersController@settings');
    Route::resource('users', 'Administration\UsersController');

    //  Modules
    Route::get('modules/datatable', 'Administration\ModulesController@datatable');
    Route::resource('modules', 'Administration\ModulesController');

    Route::get('no-series/datatable', 'Administration\NumberSeriesController@datatable');
    Route::resource('no-series', 'Administration\NumberSeriesController');

    //  Reason/Purpose
    Route::put('reason/active', 'Administration\ReasonController@activate');
    Route::put('reason/inactive', 'Administration\ReasonController@deactivate');
    Route::get('reason/datatable', 'Administration\ReasonController@datatable');
    Route::resource('reason', 'Administration\ReasonController');

    //  Roles/Positions
    Route::get('position/datatable', 'Administration\RolesController@datatable');
    Route::get('position/type/{typeId}', 'Administration\RolesController@type');
    Route::resource('position', 'Administration\RolesController');

    //  Attributes
    //  Functions
    Route::put('attributes/{attributeId}/active', 'Administration\AttributeDetailController@activate');
    Route::put('attributes/{attributeId}/inactive', 'Administration\AttributeDetailController@deactivate');

    Route::post('attributes/{attributeId}', 'Administration\AttributeDetailController@store');
    Route::put('attributes/{attributeId}/{attributeDetailCode}', 'Administration\AttributeDetailController@update');

    Route::get('attributes/{attributeId}', 'Administration\AttributeDetailController@index');
    Route::get('attributes/{attributeId}/datatable', 'Administration\AttributeDetailController@datatable');
    Route::get('attributes/{attributeId}/create', 'Administration\AttributeDetailController@create');
    Route::get('attributes/{attributeId}/{attributeDetailCode}/edit', 'Administration\AttributeDetailController@edit');
    Route::get('attributes/{attributeId}/{attributeDetailCode}/delete', 'Administration\AttributeDetailController@destroy');
});

Route::group(['prefix' => 'financial-management', 'middleware' => ['auth']], function () {
    Route::get('/', 'FinancialManagement\FinancialManagementController@index');

    $routes = [
        'cash-advance'
    ];

    assignRoutes($routes, "FinancialManagement");
});

//Route::group(['prefix' => 'hris', 'middleware' => ['auth']], function () {
Route::group(['prefix' => 'human-resource-recruitment', 'middleware' => ['auth']], function () {
    Route::get('/', 'HRIS\HRISController@index');

    $routes = [
        'employee-profile'
    ];

    assignRoutes($routes, "HRIS");
});
