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

// Home routes ..
Route::get('/', 'HomeController@getIndex');

// Dashboard
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', ['as' =>'dashboard', 'uses' => 'DashboardController@getIndex']);
    Route::get('/dashboard/noticia', ['as' =>'dashboard/noticia', 'uses' => 'DashboardController@getListNoticia']);
});

// Scraper
Route::get('elcomercio', 'Scraper\ElcomercioController@getIndex');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);



