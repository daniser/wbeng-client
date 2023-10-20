<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights\Response\FlightGroup\Itinerary;

use JMS\Serializer\Annotation\Type;

class Flight
{
    public function __construct(

        public string $token,

        /** @var list<Flight\Segment> */
        #[Type('list<TTBooking\WBEngine\DTO\Air\SearchFlights\Response\FlightGroup\Itinerary\Flight\Segment>')]
        public array $segments,

        public int $travelDuration,

        public string $seatsAvailable,

    ) {
    }
}
