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

Route::get('/', 'UserController@index');
Route::get('/logout', 'UserController@logout');

Route::post('/branch', 'UserController@login');

Route::get('/basic/user', 'UserController@create');

Route::get('/business', 'BusinessController@index');
Route::get('/construction', 'ConstructionController@index');