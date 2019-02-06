<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Helpers/PlatformHelper.php');
        require_once app_path('Helpers/PatronHelper.php');
        require_once app_path('Helpers/RingHelper.php');
        require_once app_path('Helpers/TileHelper.php');
        require_once app_path('Helpers/BuildFeedHelper.php');
    }
}
