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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('user/{id}', 'Jg\UserController@showProfile');
Route::get('user/login', 'Jg\CustomerController@showLogin');


Route::group(['prefix' => 'admin/jg', 'middleware' => ['addheader']], function () {

    Route::group(['middleware' => ['auth', 'role']], function () {


        Route::group(['prefix' => 'customer'], function () {
            Route::get('index', 'Jg\CustomerController@tpl');
            Route::get('list', 'Jg\CustomerController@getList');
            Route::post('edit', 'Jg\CustomerController@editRow');
        });
        Route::group(['prefix' => 'user'], function () {
            Route::get('index', 'Jg\UserController@tpl');
            Route::get('list', 'Jg\UserController@getList');
            Route::post('edit', 'Jg\UserController@editRow');
        });
    });

    Route::group(['prefix' => 'login'], function () {
        Route::get('index', 'Jg\LoginController@tpl');
        Route::post('login', 'Jg\LoginController@login');
        Route::get('logout', 'Jg\LoginController@logout');
    });
});
