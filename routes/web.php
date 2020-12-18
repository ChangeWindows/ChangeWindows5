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

// Legacy routes, by the end of 6.0, these should all be under "front"
Route::get('/', 'TimelineController@index')->name('timeline');
Route::get('/build/{build}/{platform?}', 'TimelineController@redirect')->name('showRelease');

Route::get('/milestones', 'MilestoneController@index')->name('milestones');
Route::get('/milestones/{id}', 'MilestoneController@show')->name('showMilestone');
Route::get('/milestones/{id}/{platform}', 'MilestoneController@platform')->name('platformMilestone');

Route::get('/rings', 'RingsController@index')->name('rings');
Route::get('/rings/{platform}', 'RingsController@platform')->name('platformRings');

Route::get('/buildfeed', 'BuildfeedController@index')->name('buildfeed');
Route::get('/buildfeed/about', 'BuildfeedController@about')->name('aboutBuildfeed');
Route::get('/buildfeed/{id}', 'BuildfeedController@show')->name('showBuildfeed');

Route::get('/vnext/{platform?}', 'vNextController@index')->name('showVNext');
Route::get('/vnext/{platform}/edit', 'vNextController@edit')->name('editVNext');
Route::patch('/vnext/{platform?}', 'vNextController@update')->name('updateVNext');

Route::get('/viv', 'VivController@index')->name('viv');
Route::get('/viv/terms', 'VivController@terms')->name('vivTerms');
Route::get('/viv/changelog', 'VivController@changelog')->name('vivChangelog');
Route::get('/viv/privacy', 'VivController@privacy')->name('vivPrivacy');

// Frontend
Route::name('front')->group(function() {
    Route::middleware(['auth'])->prefix('profile')->name('.profile')->group(function() {
        Route::get('', 'ProfileController@index')->name('');
        Route::get('/password', 'ProfileController@password')->name('.password');
        Route::patch('/{user}', 'ProfileController@update')->name('.update');
        Route::patch('/{user}/password', 'ProfileController@changePassword')->name('.changePassword');
    });
});

// Backstage
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
        Route::get('', 'Admin\SettingsController@index')->name('');
        Route::patch('',  'Admin\SettingsController@update')->name('.update');
    });

    // Accounts
    Route::prefix('accounts')->name('.accounts')->group(function() {
        Route::get('', 'Admin\AccountController@index')->name('');
        Route::get('/{user}', 'Admin\AccountController@edit')->name('.edit');
        Route::patch('/{user}', 'Admin\AccountController@update')->name('.update');
        Route::delete('/{user}', 'Admin\AccountController@destroy')->name('.delete');
    });

    // Milestones
    Route::prefix('milestones')->name('.milestones')->group(function() {
        Route::get('', 'Admin\MilestoneController@index')->name('');
        Route::get('/{milestone}', 'Admin\MilestoneController@edit')->name('.edit');
        Route::post('', 'Admin\MilestoneController@store')->name('.store');
        Route::patch('/{milestone}', 'Admin\MilestoneController@update')->name('.update');
        Route::delete('/{milestone}', 'Admin\MilestoneController@destroy')->name('.delete');
    });
    
    Route::prefix('milestonePlatforms')->name('.milestonePlatforms')->group(function() {
        Route::post('/{milestone}/{platform}', 'Admin\MilestonePlatformController@store')->name('.store');
        Route::delete('/{milestone_platform}', 'Admin\MilestonePlatformController@destroy')->name('.delete');
    });
    
    Route::prefix('channelMilestonePlatforms')->name('.channelMilestonePlatforms')->group(function() {
        Route::post('/{milestone_platform}/{channel_platform}', 'Admin\ChannelMilestonePlatformController@store')->name('.store');
        Route::patch('/{channel_milestone_platform}', 'Admin\ChannelMilestonePlatformController@toggle')->name('.toggle');
        Route::delete('/{channel_milestone_platform}', 'Admin\ChannelMilestonePlatformController@destroy')->name('.delete');
    });

    // Flights
    Route::prefix('flights')->name('.flights')->group(function() {
        Route::get('', 'Admin\FlightController@index')->name('');
        Route::get('/{release}', 'Admin\FlightController@edit')->name('.edit');
        Route::post('', 'Admin\FlightController@store')->name('.store');
        Route::patch('/{release}', 'Admin\FlightController@update')->name('.update');
        Route::delete('/{release}', 'Admin\FlightController@destroy')->name('.delete');
    });

    // Logs
    Route::prefix('changelogs')->name('.changelogs')->group(function() {
        Route::get('', 'Admin\ChangelogController@index')->name('');
        Route::get('/{log}', 'Admin\ChangelogController@edit')->name('.edit');
        Route::post('', 'Admin\ChangelogController@store')->name('.store');
        Route::patch('/{log}', 'Admin\ChangelogController@update')->name('.update');
        Route::delete('/{log}', 'Admin\ChangelogController@destroy')->name('.delete');
    });

    // Platforms
    Route::prefix('platforms')->name('.platforms')->group(function() {
        Route::get('', 'Admin\PlatformController@index')->name('');
        Route::get('/create', 'Admin\PlatformController@create')->name('.create');
        Route::get('/{platform}/edit', 'Admin\PlatformController@edit')->name('.edit');
        Route::post('', 'Admin\PlatformController@store')->name('.store');
        Route::patch('/{platform}', 'Admin\PlatformController@update')->name('.update');
        Route::delete('/{platform}', 'Admin\PlatformController@destroy')->name('.delete');
    });
    
    Route::prefix('channelPlatforms')->name('.channelPlatforms')->group(function() {
        Route::post('', 'Admin\ChannelPlatformController@store')->name('.store');
        Route::patch('/{channel_platform}', 'Admin\ChannelPlatformController@toggle')->name('.toggle');
        Route::delete('/{channel_platform}', 'Admin\ChannelPlatformController@destroy')->name('.delete');
    });

    // Channels
    Route::prefix('channels')->name('.channels')->group(function() {
        Route::get('', 'Admin\ChannelController@index')->name('');
        Route::get('/create', 'Admin\ChannelController@create')->name('.create');
        Route::get('/{channel}/edit', 'Admin\ChannelController@edit')->name('.edit');
        Route::post('', 'Admin\ChannelController@store')->name('.store');
        Route::patch('/{channel}', 'Admin\ChannelController@update')->name('.update');
        Route::delete('/{channel}', 'Admin\ChannelController@destroy')->name('.delete');
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
