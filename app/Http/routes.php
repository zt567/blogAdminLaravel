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

Route::group(['middleware' => ['web']],function(){

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/getcode','Admin\LoginController@getcode');
    Route::get('/makecode','Admin\LoginController@makecode');

});

    Route::get('/admin/index','Admin\IndexController@index');
    Route::any('/admin/info','Admin\IndexController@info');



    Route::any('/admin/login','Admin\LoginController@login');
    Route::any('/admin/crypt','Admin\LoginController@crypt');
