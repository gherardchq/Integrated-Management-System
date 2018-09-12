<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/reportar', 'HomeController@getReport');
Route::post('/reportar', 'HomeController@postReport');


Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {	
	
//User
	Route::get('/usuarios', 'UserController@index');
	Route::post('/usuarios', 'UserController@store');
	Route::get('/usuario/{id}', 'UserController@edit');
	Route::post('/usuario/{id}', 'UserController@update');
	Route::get('/usuario/{id}/eliminar', 'UserController@delete');

//Project
	Route::get('/proyectos', 'ProjectController@index');
	Route::post('/proyectos', 'ProjectController@store');
	Route::get('/proyecto/{id}', 'ProjectController@edit');
	Route::post('/proyecto/{id}', 'ProjectController@update');
	Route::get('/proyecto/{id}/eliminar', 'ProjectController@delete');
	Route::get('/proyecto/{id}/restaurar', 'ProjectController@restore');

// Category
	Route::post('/categorias', 'CategoryController@store');
	Route::post('/categoria/{id}', 'CategoryController@update');

// Level
	Route::post('/niveles', 'LevelController@store');
	Route::post('/nivel/{id}', 'LevelController@update');

	Route::get('/config', 'ConfigController@index');
});