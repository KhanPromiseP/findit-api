<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
 
    
    Model::preventLazyLoading();



    // Enable view caching
    view()->addLocation(resource_path('views'));
}
}



