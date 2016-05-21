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

/**
 * Login/Logout
 */
// First page
Route::get('/', 'UserController@index');
// Login
Route::post('/branch', 'UserController@login');
// Go to main menu
Route::get('/branch', 'UserController@main');
// Logout
Route::get('/logout', 'UserController@logout');

/**
 * Basic
 */
// User
Route::get('/basic/user', 'UserController@create');
Route::post('/basic/user', 'UserController@store');
Route::get('/basic/user/{id}/edit', 'UserController@edit');
Route::patch('/basic/user/{id}', 'UserController@update');
Route::get('/basic/user/{id}/delete', 'UserController@destroy');
// Officeman
Route::get('/basic/officeman', 'OfficemanController@index');
// Office
Route::resource('/basic/office', 'OfficeController');
Route::get('/basic/office/{office}/delete', 'OfficeController@destroy');
// Item
Route::resource('/basic/item', 'ItemController');
Route::get('/basic/item/{item}/delete', 'ItemController@destroy');
// Officeman
Route::resource('/basic/officeman', 'OfficemanController');
Route::get('/basic/officeman/{officeman}/delete', 'OfficemanController@destroy');
// Company
Route::resource('/basic/company', 'CompanyController');
Route::get('/basic/company/{company}/delete', 'CompanyController@destroy');
// CompanyMan
Route::resource('/basic/companyman', 'CompanyManController');
Route::get('/basic/companyman/{companyman}/delete', 'CompanyManController@destroy');
    // - Select Office Change
Route::get('basic/companyman_companiesFromOffice', 'CompanyManController@companiesFromOffice');
// Manager
Route::resource('basic/manager', 'ManagerController');
Route::get('basic/manager/{manager}/delete', 'ManagerController@destroy');

/**
 * Application
 */
// Business Calendar
Route::get('/business', 'BusinessController@index');
Route::post('/business', 'BusinessController@index');
Route::get('business/update', 'BusinessController@update');
Route::get('business/updateOrderState', 'BusinessController@updateOrderState');
Route::get('business/editCheck', 'BusinessController@editCheck');
// Construction Calendar
Route::resource('construction', 'ConstructionController');