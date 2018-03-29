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
    return view('welcome');
});

Auth::routes();
Route::get('active-acount/{active_code}', 'Auth\ActivateController@active')->name('auth.activate');

Route::get('/', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'web']], function() {
	Route::get('', 'SystemController@index')->name('index');
	Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
	// Route::resource('user', 'UserController', ['except' => ['show']]);
		Route::get('', 'UserController@index')->name('index');
		Route::get('create', 'UserController@create')->name('create');
		Route::post('create', 'UserController@store');
		Route::get('edit/{id}', 'UserController@edit')->name('edit');
		Route::post('edit/{id}', 'UserController@update');
		Route::get('remove/{id}', 'UserController@destroy')->name('destroy');
	});
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
