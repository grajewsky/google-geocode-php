<?php

declare(strict_types=1);

namespace Gappsky\GoogleApi\Geocode;

use GuzzleHttp\Client;

class GoogleGeocodeApi
{
    const URL = "https://maps.googleapis.com/maps/api/geocode/json";

    /**
     * @var string
     */
    private $key;

    /**
     * @var bool
     */
    private $verifySSL = true;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var Client
     */
    private $client;

    /**
     * GoogleGeocodeApi constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey, bool $verifySSL, array $headers)
    {
        $this->key = $apiKey;
        $this->verifySSL = $verifySSL;
        $this->headers = $headers;

        $this->client = new Client([
            'base_uri' => self::URL,
            'headers' => $headers
        ]);
    }
}