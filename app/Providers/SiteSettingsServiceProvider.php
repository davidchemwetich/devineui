<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;

class SiteSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // check if the site_settings table exists to avoid errors during migrations.
        if (Schema::hasTable('site_settings')) {
            // Fetch the first record of site settings.
            // Using first() is efficient 
            $siteSettings = SiteSetting::first();

            // Share the siteSettings variable with all views.
            View::share('siteSettings', $siteSettings);
        }
    }
}
