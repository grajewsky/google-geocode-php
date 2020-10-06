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
            $verifySsl = isset($app['config']['google-geocode.verify_ssl'])
                ? $app['config']['google-geocode.verify_ssl']
                : true;
            $headers = isset($app['config']['google-geocode.headers'])
                ? $app['config']['google-geocode.headers']
                : [];
            return new GoogleGeocodeApi($key, $verifySsl, $headers);
        });

        $this->mergeConfigFrom(__DIR__ . "/../config/google-geocode.php", "google-geocode");

    }
}