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
Route::get('/', ['as' =>'home', 'uses' => 'HomeController@getIndex']);
Route::get('/test', ['as' =>'test', 'uses' => 'HomeController@test']);

//Route test
Route::get('/testapi', ['as' =>'testapi', 'uses' => 'TestController@test']);
Route::get('/test-locations', ['as' =>'testlocations', 'uses' => 'TestController@testLocation']);
Route::get('/test/googlemaps', ['as' =>'testgooglemaps', 'uses' => 'Test\TestController@test']);
Route::get('/jade-render', ['as' =>'jaderender', 'uses' => 'Test\TestController@jade']);
Route::get('/jade-render2', ['as' =>'jaderender', 'uses' => 'Test\TestController@jadeEngine']);
Route::get('/test-config', function() {
    dd($this->app->config);
});

// Dashboard
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', ['as' =>'dashboard', 'uses' => 'DashboardController@getIndex']);

    Route::resource('dashboard/noticia', 'DashboardCrudNoticiaController');

    /*Route::get('/dashboard/noticia', ['as' =>'dashboard/noticia', 'uses' => 'DashboardController@getListNoticia']);
    Route::get('/dashboard/noticia/edit', ['as' =>'/dashboard/noticia/edit', 'uses' => 'DashboardController@getListNoticia']);
    Route::get('/dashboard/noticia/destroy', ['as' =>'dashboard/noticia/destroy', 'uses' => 'DashboardController@getListNoticia']);*/
    Route::get('/dashboard/preview', ['as' =>'dashboard/preview', 'uses' => 'DashboardController@getPreview']);
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



