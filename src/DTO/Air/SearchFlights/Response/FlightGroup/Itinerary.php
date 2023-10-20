<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights\Response\FlightGroup;

use JMS\Serializer\Annotation\Type;

class Itinerary
{
    public function __construct(

        /** @var list<Itinerary\Flight> */
        #[Type('list<TTBooking\WBEngine\DTO\Air\SearchFlights\Response\FlightGroup\Itinerary\Flight>')]
        public array $flights,

    ) {
    }
}
