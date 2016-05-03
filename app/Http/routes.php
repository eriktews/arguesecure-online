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

Route::get('/instructions', ['as' => 'instructions', 'uses' => 'StaticPageController@instructions']);

/**
 * With Auth Middleware
 */
Route::group(['middleware' => ['auth', 'heartbeat']], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'TreeController@index']);

    Route::get('/help', ['as' => 'help', 'uses' => 'StaticPageController@help']);

    Route::get('/superuser', ['as' => 'superuser', 'uses' => 'StaticPageController@superuser']);
    Route::get('/superuser/pdfsheet', ['as' => 'superuser.pdfsheet', 'uses' => 'StaticPageController@pdfsheet']);
    Route::get('/superuser/csvuser', ['as' => 'superuser.csvuser', 'uses' => 'StaticPageController@csvusercreate']);
    Route::get('/superuser/adminpassword', ['as' => 'superuser.adminpassword', 'uses' => 'StaticPageController@adminpassword']);
    Route::post('/superuser/adminpassword', ['as' => 'superuser.setadminpassword', 'uses' => 'StaticPageController@setadminpassword']);
    Route::get('/superuser/useradmin', ['as' => 'superuser.useradmin', 'uses' => 'StaticPageController@useradmin']);
    Route::post('/superuser/useradmin/createuser', ['as' => 'superuser.useradmin.create', 'uses' => 'StaticPageController@createUser']);
    Route::delete('/superuser/useradmin/{user}/deleteuser', ['as' => 'superuser.useradmin.delete', 'uses' => 'StaticPageController@deleteUser']);

    Route::post('/ajax/node/startUpdate', ['as' => 'node.ajax.startUpdate', 'uses' => 'NodeController@nodeStartUpdate']);
    Route::post('/ajax/node/stopUpdate', ['as' => 'node.ajax.stopUpdate', 'uses' => 'NodeController@nodeStopUpdate']);

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

    Route::delete('defence/{defence}', ['as'=>'defence.destroy', 'uses' => 'DefenceController@destroy']);
    
    Route::resource('attack.defence', 'DefenceController', [
        'names' => [
            'show' => 'defence.show',
            'create' => 'defence.create',
            'store' => 'defence.store',
            'edit' => 'defence.edit',
            'update' => 'defence.update'
        ],
        'except' => [
            'index',
            'destroy'
        ]
    ]);

    Route::get('tree/{tree}/export', ['as'=>'tree.export', 'uses' => 'TreeController@export']);

    Route::resource('tree', 'TreeController');

	Route::get('heartbeat', ['middleware' => ['throttle:10,1'], 'as' => 'heartbeat', 'uses' => 'HeartbeatController@beat']);

	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
});
