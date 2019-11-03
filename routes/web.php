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

Route::get('/home', 'PostController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'post'], function () {
    Route::get('create', 'PostController@create')->name('create-post');
    Route::post('save', 'PostController@store')->name('save-post');
    Route::get('/{id}', 'PostController@show')->name('show-post');
    Route::get('/edit/{id}', 'PostController@edit')->name('edit-post');
    Route::put('/update/{id}', 'PostController@update')->name('update-post');
    Route::delete('/delete/{id}', 'PostController@destroy')->name('delete-post');
});
Route::group(['middleware' => 'auth', 'prefix' => 'comment'], function () {
    Route::get('create/{post_id}', 'CommentController@create')->name('create-comment');
    Route::post('save', 'CommentController@store')->name('save-comment');
    Route::get('/edit/{id}', 'CommentController@edit')->name('edit-comment');
    Route::put('/update/{id}', 'CommentController@update')->name('update-comment');
    Route::delete('/delete/{id}', 'CommentController@destroy')->name('delete-comment');
});
