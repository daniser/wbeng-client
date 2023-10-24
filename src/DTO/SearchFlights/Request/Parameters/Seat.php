<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters;

use TTBooking\WBEngine\DTO\Enums\PassengerType;

class Seat
{
    public function __construct(
        public int $count = 1,

        public PassengerType $passengerType = PassengerType::Adult,
    ) {}
}