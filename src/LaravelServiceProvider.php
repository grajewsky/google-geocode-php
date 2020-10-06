<?php

declare(strict_types=1);

namespace Gappsky\GoogleApi\Geocode;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(GoogleGeocodeApi::class, function ($app) {
            $key = isset($app['config']['google-geocode.key'])
                ? $app['config']['google-geocode.key'] : null;
            return new GoogleGeocodeApi($key);
        });

        $this->mergeConfigFrom(__DIR__ . "/../config/google-geocode.php", "google-geocode");

    }
}