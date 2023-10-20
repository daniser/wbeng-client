<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\FlightFares\Request;

use JMS\Serializer\Annotation\Type;

class FlightGroup
{
    public function __construct(

        public string $token,

        /** @var list<Itinerary> */
        #[Type('list<TTBooking\WBEngine\DTO\Air\FlightFares\Request\Itinerary>')]
        public array $itineraries,

    ) {
    }
}
