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
Route::feeds();

Route::get('/', 'TimelineController@index')->name('timeline');
Route::get('/build/{build}/{platform?}', 'TimelineController@redirect')->name('showRelease');

Route::get('/log/new', 'LogController@create')->name('createLog');
Route::get('/log/{id}/edit', 'LogController@edit')->name('editLog');
Route::get('/log/{platform?}/{build?}', 'LogController@index')->name('showLogs');

Route::get('/milestones', 'MilestoneController@index')->name('milestones');
Route::get('/milestones/{id}', 'MilestoneController@show')->name('showMilestone');
Route::get('/milestones/{id}/{platform}', 'MilestoneController@platform')->name('platformMilestone');

Route::get('/rings', 'RingsController@index')->name('rings');
Route::get('/rings/{platform}', 'RingsController@platform')->name('platformRings');

Route::get('/buildfeed', 'BuildfeedController@index')->name('buildfeed');
Route::get('/buildfeed/about', 'BuildfeedController@about')->name('aboutBuildfeed');
Route::get('/buildfeed/{id}', 'BuildfeedController@show')->name('showBuildfeed');

Route::get('/vnext/{platform?}', 'vNextController@index')->name('showVNext');

Route::get('/users', 'UserController@index')->name('showUsers');

Route::get('/viv', 'VivController@index')->name('viv');
Route::get('/viv/terms', 'VivController@terms')->name('vivTerms');
Route::get('/viv/changelog', 'VivController@changelog')->name('vivChangelog');
Route::get('/viv/privacy', 'VivController@privacy')->name('vivPrivacy');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::patch('/profile/{id}', 'ProfileController@edit')->name('updateProfile');