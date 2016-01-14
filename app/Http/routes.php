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

    Route::get('/ajax/node/tree/{tree}', ['as' => 'node.ajax.tree', 'uses' => 'NodeController@nodeTreeVis']);
    Route::get('/ajax/node/risk/{risk}', ['as' => 'node.ajax.risk', 'uses' => 'NodeController@nodeTreeVis']);
    Route::get('/ajax/node/attack/{attack}', ['as' => 'node.ajax.attack', 'uses' => 'NodeController@nodeTreeVis']);
    Route::get('/ajax/node/defence/{defence}', ['as' => 'node.ajax.defence', 'uses' => 'NodeController@nodeTreeVis']);

    Route::delete('risk/{risk}', ['as'=>'risk.destroy', 'uses' => 'RiskController@destroy']);

    Route::resource('tree.risk', 'RiskController', [
    	'names' => [
    	    'show' => 'risk.show',
    	    'create' => 'risk.create',
    	    'store' => 'risk.store',
    	    'edit' => 'risk.edit',
    	    'update' => 'risk.update'
    	],
    	'except' => [
    		'index',
            'destroy'
		]
	]);

    Route::delete('attack/{attack}', ['as'=>'attack.destroy', 'uses' => 'AttackController@destroy']);
    
    Route::resource('risk.attack', 'AttackController', [
        'names' => [
            'show' => 'attack.show',
            'create' => 'attack.create',
            'store' => 'attack.store',
            'edit' => 'attack.edit',
            'update' => 'attack.update'
        ],
        'except' => [
            'index',
            'destroy'
        ]
    ]);

    Route::resource('tree', 'TreeController');
    

	Route::get('heartbeat', ['middleware' => [/*'throttle:10,1'*/], 'as' => 'heartbeat', 'uses' => 'HeartbeatController@beat']);

	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
});

Route::get('lock', function() {
	\App\Tree::all()->first()->lock();
});
