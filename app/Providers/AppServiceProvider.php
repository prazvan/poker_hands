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

        $this->determinateRequestProtocol();
    }

    /**
     * used to terminate if we run on http&https.
     * we use this just to make sure that everything loads on ether http or https :)
     *
     */
    private function determinateRequestProtocol(): void
    {
        if (request()->getPort() !== (int) env('UNSECURED_PORT'))
        {
            self::$scheme .= 's';
        }

        URL::forceScheme(self::$scheme);
    }

}

