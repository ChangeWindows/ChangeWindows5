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

Auth::routes();

Route::get('/', 'TimelineController@index')->name('timeline');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/viv', 'PreviewController@index')->name('viv');
