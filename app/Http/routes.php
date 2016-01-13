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
 * Authentication and register routes
 */

Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'login-post', 'uses' => 'Auth\AuthController@postLogin']);

/**
 * With Auth Middleware
 */
Route::group(['middleware' => ['auth', 'heartbeat']], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'TreeController@index']);

    Route::get('/ajax/tree/{tree}', ['as' => 'tree.ajax', 'uses' => 'TreeController@ajax']);

    Route::get('/ajax/node/{tree}/{risk?}/{attack?}/{defence?}', ['as' => 'node.ajax', 'uses' => 'TreeController@nodeTreeVis']);

    Route::resource('tree', 'TreeController');

	Route::get('heartbeat', ['middleware' => [/*'throttle:10,1'*/], 'as' => 'heartbeat', 'uses' => 'HeartbeatController@beat']);

	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
});

Route::get('lock', function() {
	\App\Tree::all()->first()->lock();
});
