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
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::any('/','Admin\LoginController@root');
Route::any('/admin/login','Admin\LoginController@login');
Route::any('/makecode','Admin\LoginController@makecode');

    
Route::group(['prefix'=>'admin','namespace'=>'Admin'], function () {
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');
    Route::post('cate/changeorder', 'CategoryController@changeOrder');
    Route::resource('category', 'CategoryController');
    Route::resource('article', 'ArticleController');
    Route::any('upload', 'CommonController@upload');
});