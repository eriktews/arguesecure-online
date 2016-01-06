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

use App\Events\TreeEvents\TreeCreated;

/**
 * Authentication and register routes
 */

Route::get('login', ['as' => 'login' , 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'login-post', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

/**
 * With Auth Middleware
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
		return view('home');
    });
});

Route::get('test', function () {
	$tree = new \App\Tree;
	$tree->name = "test tree";
	$tree->save();
	$tree->delete();
	return 'event Fired';
});