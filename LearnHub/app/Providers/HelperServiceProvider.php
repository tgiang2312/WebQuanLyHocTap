<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\CategoryHelper;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('category', function () {
            return new CategoryHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
