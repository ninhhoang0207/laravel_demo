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
		Route::resource('user', 'UserController');
		Route::resource('role', 'RoleController');
	});
	Route::get('disease/get-data', 'DiseaseController@getData')->name('disease.getData');
	Route::get('disease/add-disease-gene', 'DiseaseController@addDiseaseGene')->name('disease.addDiseaseGene');
	Route::get('disease/detail/{disease}', 'DiseaseController@detail')->name('disease.detail');
	Route::resource('disease', 'DiseaseController');
	Route::get('gene/search-gene', 'GeneController@searchGene')->name('gene.searchGene');
});

Route::get('/home', 'HomeController@index')->name('home');
