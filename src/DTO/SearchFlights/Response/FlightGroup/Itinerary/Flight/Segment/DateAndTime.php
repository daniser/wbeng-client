<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response\FlightGroup\Itinerary\Flight\Segment;

class DateAndTime
{
    public function __construct(

        public string $date,

        public string $time,

    ) {
    }
}
