<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\FlightFares\Request;

class Flight
{
    public function __construct(

        public string $token,

    ) {
    }
}
