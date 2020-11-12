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
Route::patch('/log/{id}', 'LogController@update')->name('updateLogs');
Route::post('/log', 'LogController@store')->name('storeLogs');

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
Route::post('/flight', 'FlightController@store')->name('storeFlight');
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

Route::middleware(['auth'])->prefix('admin')->name('admin')->group(function() {
    // Dashboard
    Route::get('', 'Admin\DashboardController@index');

    Route::prefix('dashboard')->name('.dashboard')->group(function() {
        Route::get('', 'Admin\DashboardController@index')->name('');
        Route::put('/onboarding', 'Admin\DashboardController@onboarding')->name('.onboarding');
    });

    // Search
    Route::prefix('search')->name('.search')->group(function() {
        Route::get('', 'Admin\SearchController@index')->name('');
        Route::post('', 'Admin\SearchController@results')->name('.find');
    });

    // About
    Route::get('/about', 'Admin\AboutController@index')->name('.about');

    // Settings
    Route::prefix('settings')->name('.settings')->group(function() {
        Route::get('', 'Admin\SettingsController@indexGeneral')->name('');
        Route::get('/general', 'Admin\SettingsController@indexGeneral')->name('.general');
        Route::patch('/general',  'Admin\SettingsController@updateGeneral')->name('.general.update');
    });

    // Accounts
    Route::prefix('accounts')->name('.accounts')->group(function() {
        Route::get('', 'Admin\AccountController@index')->name('');
        Route::get('/{user}', 'Admin\AccountController@edit')->name('.edit');
        Route::patch('/{user}', 'Admin\AccountController@update')->name('.update');
        Route::delete('/{user}', 'Admin\AccountController@destroy')->name('.delete');
    });

    // Permissions
    Route::prefix('roles')->name('.roles')->group(function() {
        Route::get('', 'Admin\RoleController@index')->name('');
        Route::get('/{role}/edit', 'Admin\RoleController@edit')->name('.edit');
        Route::patch('/{role}', 'Admin\RoleController@update')->name('.update');
        Route::post('', 'Admin\RoleController@store')->name('.store');
        Route::delete('/{role}', 'Admin\RoleController@destroy')->name('.delete');
        Route::put('/{role}/toggle/{ability}', 'Admin\RoleController@toggle')->name('.toggle');
        Route::patch('/{role}/active', 'Admin\RoleController@default')->name('.default');
    });

    Route::prefix('abilities')->name('.abilities')->group(function() {
        Route::get('', 'Admin\AbilityController@index')->name('');
        Route::get('/{ability}/edit', 'Admin\AbilityController@edit')->name('.edit');
        Route::patch('/{ability}', 'Admin\AbilityController@update')->name('.update');
        Route::post('', 'Admin\AbilityController@store')->name('.store');
        Route::delete('/{ability}', 'Admin\AbilityController@destroy')->name('.delete');
    });
});