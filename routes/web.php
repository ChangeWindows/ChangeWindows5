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
Route::post('/build', 'TimelineController@store')->name('storeRelease');
Route::get('/build/{build}/{platform?}', 'TimelineController@show')->name('showRelease');

Route::get('/changelog/new', 'ChangelogController@create')->name('createChangelog');
Route::get('/changelog/{id}/edit', 'ChangelogController@edit')->name('editChangelog');
Route::get('/changelog/{platform?}/{build?}', 'ChangelogController@index')->name('showChangelogs');
Route::patch('/changelog/{id}', 'ChangelogController@update')->name('updateChangelogs');
Route::post('/changelog', 'ChangelogController@store')->name('storeChangelogs');

Route::get('/milestones', 'MilestoneController@index')->name('milestones');
Route::get('/milestones/{id}', 'MilestoneController@show')->name('showMilestone');
Route::get('/milestones/{id}/edit', 'MilestoneController@edit')->name('editMilestone')->middleware('auth');
Route::get('/milestones/{id}/{platform}', 'MilestoneController@platform')->name('platformMilestone');
Route::post('/milestones', 'MilestoneController@store')->name('storeMilestone')->middleware('auth');
Route::patch('/milestones/{id}', 'MilestoneController@update')->name('updateMilestone')->middleware('auth');
Route::delete('/milestones/{id}', 'MilestoneController@destroy')->name('destroyMilestone');

Route::get('/rings', 'RingsController@index')->name('rings');
Route::get('/rings/{platform}', 'RingsController@platform')->name('platformRings');

Route::get('/buildfeed', 'BuildfeedController@index')->name('buildfeed');
Route::get('/buildfeed/about', 'BuildfeedController@about')->name('aboutBuildfeed');
Route::get('/buildfeed/{id}', 'BuildfeedController@show')->name('showBuildfeed');

Route::get('/flight', 'FlightController@index')->name('showFlights');
Route::get('/flight/{id}', 'FlightController@edit')->name('editFlight');
Route::patch('/flight/{id}', 'FlightController@update')->name('updateFlight');
Route::delete('/flight/{id}', 'FlightController@destroy')->name('destroyFlight');

Route::get('/vnext/{platform?}', 'vNextController@index')->name('showVNext');
Route::get('/vnext/{platform?}/edit', 'vNextController@edit')->name('editVNext');
Route::patch('/vnext/{platform?}', 'vNextController@update')->name('updateVNext');

Route::get('/users', 'UserController@index')->name('showUsers');
Route::patch('/users/{id}/promote', 'UserController@promote')->name('promoteUser');
Route::patch('/users/{id}/demote', 'UserController@demote')->name('demoteUser');
Route::delete('/users/{id}', 'UserController@destroy')->name('deleteUser');

Route::get('/viv', 'VivController@index')->name('viv');
Route::get('/viv/terms', 'VivController@terms')->name('vivTerms');
Route::get('/viv/changelog', 'VivController@changelog')->name('vivChangelog');
Route::get('/viv/privacy', 'VivController@privacy')->name('vivPrivacy');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::patch('/profile/{id}', 'ProfileController@edit')->name('updateProfile');

Route::get('/patreons', 'PatreonController@index')->name('showPatreon');
Route::get('/patreons/new', 'PatreonController@create')->name('createPatreon');
Route::get('/patreons/{id}/edit', 'PatreonController@edit')->name('editPatreon');
Route::post('/patreons', 'PatreonController@store')->name('storePatreon');
Route::patch('/patreons/{id}', 'PatreonController@update')->name('updatePatreon');
Route::delete('/patreons/{id}', 'PatreonController@destroy')->name('deletePatreon');