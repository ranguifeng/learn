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
Route::get('home', 'AuthController@index');
Route::get('task', 'TaskController@index');
Route::get('test', 'TaskController@test');
Route::get('vp', 'TaskController@vp');

Route::get('api/users', ['middleware' => 'throttle:60,1', function () {
    return 1;
}]);

Route::group(['namespace' => 'Auth'], function () {

    Route::get('login', 'AuthController@login');
    Route::get('register', 'AuthController@register');
    Route::post('register/action', 'AuthController@register_store');
    Route::post('login/action', 'AuthController@login_action');


});
