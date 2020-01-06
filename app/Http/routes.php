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
Route::get('/', 'HomeController@index');

Route::group(['namespace' => 'Auth'], function () {
    Route::get('home', 'AuthController@index');
    Route::get('login', 'AuthController@login');
    Route::get('register', 'AuthController@register');
    Route::post('register/action', 'AuthController@registerStore');
    Route::post('login/action', 'AuthController@loginAction');
});
