<?php

declare(strict_types=1);

namespace Gappsky\GoogleApi\Geocode\Tests;

use Dotenv\Dotenv;
use Gappsky\GoogleApi\Geocode\GoogleGeocodeApi;
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

    public function testGoogleGeocodeApi()
    {
        $api = new GoogleGeocodeApi($this->key, true, []);
        $response = $api->lookup([
            'latlng' => "51.6994914,17.7730463"
        ]);
        $this->assertSame($api->getStatus(), "OK");
        $this->assertInstanceOf(Collection::class, $response);
    }
}