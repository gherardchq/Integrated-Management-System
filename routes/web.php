<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/reportar', 'HomeController@getReport');
Route::post('/reportar', 'HomeController@postReport');


Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {	
	Route::get('/usuarios', 'UserController@index');
	Route::get('/proyectos', 'ProjectController@index');
	Route::get('/config', 'ConfigController@index');
});