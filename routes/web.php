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

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::resource('category', 'CategoryController');
    Route::resource('news', 'NewsController');
    Route::resource('users', 'UserController');
    Route::get('/', 'CategoryController@index');
});

Auth::routes();

Route::get('/', 'Front\HomeController@index')->name('home');
Route::get('NewsType/{id}/{slug}.html', 'Front\HomeController@newsType')->name('news.type');
Route::get('news/{id}/{slug}.html', 'Front\HomeController@news')->name('news');

Route::post('comment/{id}', 'CommentController@postComment')->name('post.comment');
Route::get('profile', 'Front\HomeController@getProfile')->name('get.profile');
Route::put('profile', 'Front\HomeController@postProfile')->name('put.profile');
Route::get('search', 'Front\HomeController@search')->name('get.search');
