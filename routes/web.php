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
    return view('dashboard');
});

Route::group(['prefix' => 'auth', 'as' => 'auth', 'namespace' => 'Auth'], function(){
    Route::get('login', ['as' => '.login', 'uses' => 'LoginController@showLogin']);
    Route::post('login', ['as' => '.login', 'uses' => 'LoginController@login']);
    Route::get('register', ['as' => '.register', 'uses' => 'RegisterController@showRegister']);
    Route::post('register', ['as' => '.register', 'uses' => 'RegisterController@register']);
});

