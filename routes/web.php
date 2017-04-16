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
Route::get('/', function(){
    return redirect()->route('auth.login');
});

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'home', 'as' => 'home', 'namespace' => 'Home'], function(){
        Route::get('/', ['as' => '.dashboard', 'uses' => 'HomeController@dashboard']);
    });
    Route::group(['prefix' => 'accounts', 'as' => 'accounts', 'namespace' => 'Accounts'], function(){
        Route::get('/', ['as' => '.index', 'uses' => 'AccountController@index']);
        Route::get('create', ['as' => '.create', 'uses' => 'AccountController@showCreate']);
        Route::post('create', ['as' => '.create', 'uses' => 'AccountController@create']);
        Route::get('/{id}/edit', ['as' => '.edit', 'uses' => 'AccountController@showEdit']);
        Route::post('/{id}/edit', ['as' => '.edit', 'uses' => 'AccountController@edit']);
        Route::get('/{id}/delete', ['as' => '.delete', 'uses' => 'AccountController@delete']);
    });
});

Route::group(['prefix' => 'auth', 'as' => 'auth', 'namespace' => 'Auth'], function(){
    Route::get('login', ['as' => '.login', 'uses' => 'LoginController@showLogin']);
    Route::post('login', ['as' => '.login', 'uses' => 'LoginController@login']);
    Route::get('logout', ['as' => '.logout', 'uses' => 'LoginController@logout']);
    Route::get('register', ['as' => '.register', 'uses' => 'RegisterController@showRegister']);
    Route::post('register', ['as' => '.register', 'uses' => 'RegisterController@register']);
});

