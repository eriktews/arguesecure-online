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
use App\Events\UserConnected;

Route::get('/test', function() {
	Event::fire(new UserConnected());
	return "test";
});

Route::get('/', function () {
	event(new UserConnected());
	return view('basic.basic');
});

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('home', function () {
	event(new UserConnected());
	return view('basic.basic');
});