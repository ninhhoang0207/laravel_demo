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

Route::group(['middleware' => 'role:Admin'], function() {
	Route::get('register', 'App\Http\Controllers\Auth\RegisterController@register');
});
Auth::routes();

Route::get('active-acount/{active_code}', 'Auth\ActivateController@active')->name('auth.activate');

Route::get('/', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'web', 'permission:view backend']], function() {
	Route::get('dashboard', 'SystemController@index')->name('index');
	Route::get('', 'SystemController@index')->name('index');
	Route::group(['middleware' => ['role:admin']], function() {
		Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
			Route::get('', 'UserController@index')->name('index');
			Route::get('create', 'UserController@create')->name('create');
			Route::post('create', 'UserController@store');
			Route::get('edit/{id}', 'UserController@edit')->name('edit');
			Route::post('edit/{id}', 'UserController@update');
			Route::get('remove/{id}', 'UserController@destroy')->name('destroy');
		});
		Route::resource('role', 'RoleController');
	});
});

Route::get('/home', 'HomeController@index')->name('home');
