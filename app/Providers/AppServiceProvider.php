<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // App
        view()->share('appTemplate', 'layouts/app');

        // App Auth
        view()->share('appAuthTemplate', 'layouts/app_auth');
    }
}
