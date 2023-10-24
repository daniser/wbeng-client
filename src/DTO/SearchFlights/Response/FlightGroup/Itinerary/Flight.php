<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response\FlightGroup\Itinerary;

use JMS\Serializer\Annotation\Type;

class Flight
{
    public function __construct(

        public string $token,

        /** @var list<Flight\Segment> */
        #[Type('list<'.Flight\Segment::class.'>')]
        public array $segments,

        public int $travelDuration,

        public string $seatsAvailable,

    ) {
    }
}
