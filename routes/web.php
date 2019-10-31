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
// フォロー/フォロー解除を追加
Route::post('users/{user}/follow', 'FollowUserController@follow')->name('follow');
Route::delete('users/{user}/unfollow', 'FollowUserController@unfollow')->name('unfollow');

Route::get('/home', 'HomeController@index')->name('home');

// 商品検索
Route::get('/search', 'ProductController@search');
Route::post('/results', 'ProductController@results');
Route::get('/results', 'ProductController@results');


