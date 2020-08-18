<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Request scheme, default unsecured(http)
     *
     * @var string
     */
    private static string $scheme = 'http';

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
     *
     *
     *
     * @return void
     */
    public function boot()
    {
        // determinate if we use https or http
        URL::forceScheme(env('CONNECTION_PROTOCOL', static::$scheme));
    }
}