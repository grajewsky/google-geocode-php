<?php

declare(strict_types=1);

namespace Gappsky\GoogleApi\Geocode;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

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
     * @var string
     */
    private $status;

    /**
     * GoogleGeocodeApi constructor.
     * @param string $apiKey
     * @param bool $verifySSL
     * @param array $headers
     */
    public function __construct(string $apiKey, bool $verifySSL, array $headers)
    {
        $this->key = $apiKey;
        $this->verifySSL = $verifySSL;

        $this->client = new Client([
            'base_uri' => self::URL,
            'headers' => $headers
        ]);
    }

    /**
     * @param array $params
     * @return Collection
     * @throws GoogleGeocodeException
     */
    public function lookup(array $params): Collection
    {
        $response = json_decode(
            $this->client->get("", $this->options($params))->getBody()->getContents(),
            true
        );

        $this->status = $response['status'];

        $results = collect($response['results']);

        switch ($this->status) {
            case "OK":
            case "ZERO_RESULTS":
                return $results;
        }

        throw new GoogleGeocodeException("Error. Google geocode status code: {$this->status}");
    }

    public function withHeaders(array $headers): array
    {
        $this->headers = $headers;
    }

    public function getStatus()
    {
        return $this->status;
    }

    private function options(array $params)
    {
        $options = [
            'query' => [
                'key' => $this->key
            ]
        ];

        $options['verify'] = $this->verifySSL;

        if (!empty($this->headers)) {
            $options['headers'] = $this->headers;
        }

        $options['query'] = array_merge($options['query'], $params);

        return $options;
    }
}