<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $menuJson = file_get_contents(base_path('resources/menu/index.json'));
        $menuData = json_decode($menuJson);
        \View::share('menuData', [$menuData]);
    }
}
