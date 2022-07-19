<?php

declare(strict_types=1);

namespace Gappsky\GoogleApi\Geocode\Tests;

use Dotenv\Dotenv;
use Gappsky\GoogleApi\Geocode\GoogleGeocodeApi;
use Gappsky\GoogleApi\Geocode\GoogleGeocodeException;
use Illuminate\Support\Collection;

class GoogleGeocodeApiTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Dotenv
     */
    private $env;

    /**
     * @var string
     */
    private $key;

    public function setUp(): void
    {
        parent::setUp();
        $this->env = Dotenv::createImmutable(__DIR__ . "/../");
        $this->env->load();

        $this->key = $_ENV['GOOGLE_API_KEY'];
    }

    public function testGoogleGeocodeApiExpectRequestDenied()
    {
        $api = new GoogleGeocodeApi("emptykey", true, []);
        try {
            $response = $api->lookup([
                'latlng' => "51.6994914,17.7730463"
            ]);
        } catch (GoogleGeocodeException $exception) {
            $this->assertSame($exception->getStatus(), "REQUEST_DENIED");
        }
    }

    public function testGoogleGeocodeApi()
    {
        $api = new GoogleGeocodeApi($this->key, true, []);
        try {
            $response = $api->lookup([
                'latlng' => "51.6994914,17.7730463"
            ]);
            $this->assertSame($api->getStatus(), "OK");
            $this->assertInstanceOf(Collection::class, $response);
        } catch (GoogleGeocodeException $exception) {
            $this->fail($exception->getMessage());
        }

    }
}
