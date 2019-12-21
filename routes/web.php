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

// ホーム
Route::get('/home', 'HomeController@index')->name('home');

// 商品検索・保存
   // 楽天
Route::get('/search', 'ProductController@search');
Route::post('/search', 'ProductController@toResults');
Route::get('/products/{keyword}', 'ProductController@results')->name('toResults');
Route::post('/products/{keyword}', 'ProductController@results');

// 商品お気に入り機能
Route::post('/products/{keyword}/favorite', 'FavoriteController@favorite')->name('favorite');
Route::delete('/products/{keyword}/unfavorite', 'FavoriteController@unfavorite')->name('unfavorite');

// チャット
Route::get('chat/{recieve}', 'ChatController@index')->name('chat');
Route::get('ajax/chat/{recieve}', 'Ajax\ChatController@index'); // メッセージ一覧を取得
Route::post('ajax/chat/{recieve}', 'Ajax\ChatController@create'); // チャット登録

Route::get('json/return', 'ChatController@json');




