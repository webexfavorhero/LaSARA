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

/**
 * Application
 */
// Business Calendar
Route::get('/business', 'BusinessController@index');
// Construction Calendar
Route::get('/construction', 'ConstructionController@index');