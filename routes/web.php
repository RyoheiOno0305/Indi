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

Route::get('/user/{user}/create', 'UserController@create');

Route::resource('/user', 'UserController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/personal', 'UserController@personal');
Route::get('/profile', 'UserController@profile');
Route::post('/profile','UserController@store');

Route::resource('profile', 'PhotoController');

