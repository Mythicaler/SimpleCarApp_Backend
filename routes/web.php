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
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::group(['prefix' => 'api/v1', 'namespace' => 'Api'], function()
	{
		Route::post('/auth/register', ['as' => 'auth.register', 'uses' => 'UserController@register']);
		Route::post('/auth/login', ['as' => 'auth.login', 'uses' => 'UserController@login']);
});

Route::group(['prefix' => 'cars', 'namespace' => 'Api'], function ()
{
	Route::get('/index', ['as' => 'cars.index', 'uses' => 'CarController@index']);
	Route::get('/create', ['as' => 'cars.create', 'uses' => 'CarController@create']);
	Route::post('/store', ['as' => 'cars.store', 'uses' => 'CarController@store']);
	Route::get('/search', ['as' => 'cars.search', 'uses' => 'CarController@search']);
});