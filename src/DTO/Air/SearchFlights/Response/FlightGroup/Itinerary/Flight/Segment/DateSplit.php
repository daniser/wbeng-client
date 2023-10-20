<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights\Response\FlightGroup\Itinerary\Flight\Segment;

class DateSplit
{
    public function __construct(

        public DateAndTime $departure,

        public DateAndTime $arrival,

    ) {
    }
}
