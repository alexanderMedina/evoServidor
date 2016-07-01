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

Route::get('/inde', function () {
	return view('welcome');
});

Route::group(['middleware' => ['web']], function() {

	Route::group(['prefix' => '/api'], function () {

		Route::post('/login', ['as' => 'userAuthentication', 'uses' => 'SessionController@login']
		);
		Route::post('/logout', ['as' => 'userLogout', 'uses' => 'SessionController@userLogout']
		);
		Route::post('/create/user', ['as' => 'userCreate', 'uses' => 'SessionController@create']
		);
		Route::post('/create/dogs', ['as' => 'userCreateDogs', 'uses' => 'SessionController@createDog']
		);
	});
});
