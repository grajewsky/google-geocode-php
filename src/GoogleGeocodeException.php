<?php

declare(strict_types=1);

namespace Gappsky\GoogleApi\Geocode;

use Throwable;

class GoogleGeocodeException extends \Exception
{
    private $googleStatus;

    public function __construct($status, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->googleStatus = $status;
    }

    public function getStatus()
    {
        return $this->googleStatus;
    }
}
