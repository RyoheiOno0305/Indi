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

// プロフィール
Route::resource('/user', 'UserController');

Route::get('/home', 'HomeController@index')->name('home');

// 商品検索
Route::get('/search', 'ProductController@search');
Route::post('search', 'ProductController@');
Route::get('/result', 'ProductController@rakuten_result');


