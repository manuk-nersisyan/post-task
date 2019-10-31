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
