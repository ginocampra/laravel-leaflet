<?php

namespace Ginocampra\LaravelLeaflet;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Ginocampra\LaravelLeaflet\View\Components\LaravelMap;

class LaravelLeafletServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views','LaravelLeaflet');

        Blade::component('laravel-map', LaravelMap::class);
        Blade::componentNamespace('LaravelLeaflet\\Views\\Components', 'laravel-map');
    }
}
