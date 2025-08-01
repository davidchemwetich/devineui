<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

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
        try {
            // Check if the site_settings table exists to avoid errors during migrations.
            if (Schema::hasTable('site_settings')) {
                $siteSettings = SiteSetting::first();
                View::share('siteSettings', $siteSettings);
            }
        } catch (\Throwable $e) {
            // Log a warning instead of breaking the app
            Log::warning('SiteSettingsServiceProvider skipped: ' . $e->getMessage());
        }
    }
}