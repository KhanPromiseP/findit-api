<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
            if (app()->environment('production') && request()->header('x-forwarded-proto') == 'https') {
            URL::forceScheme('https');
        }

        \Illuminate\Database\Eloquent\Model::preventLazyLoading();
        view()->addLocation(resource_path('views'));
        

        Model::preventLazyLoading();

        // Enable view caching
        view()->addLocation(resource_path('views'));
    }
}
