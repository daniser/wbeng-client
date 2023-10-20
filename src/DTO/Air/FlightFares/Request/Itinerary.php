<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\FlightFares\Request;

use JMS\Serializer\Annotation\Type;

class Itinerary
{
    public function __construct(

        public string $token,

        /** @var list<Flight> */
        #[Type('list<TTBooking\WBEngine\DTO\Air\FlightFares\Request\Flight>')]
        public array $flights,

    ) {
    }
}
