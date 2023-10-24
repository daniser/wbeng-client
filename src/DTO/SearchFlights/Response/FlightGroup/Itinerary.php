<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response\FlightGroup;

use JMS\Serializer\Annotation\Type;

class Itinerary
{
    public function __construct(

        /** @var list<Itinerary\Flight> */
        #[Type('list<'.Itinerary\Flight::class.'>')]
        public array $flights,

    ) {
    }
}
