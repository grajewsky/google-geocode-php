<?php

declare(strict_types=1);

namespace Gappsky\GoogleApi\Geocode;

class Facade extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor()
    {
        return GoogleGeocodeApi::class;
    }
}