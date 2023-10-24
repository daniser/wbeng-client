<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Request;

use JMS\Serializer\Annotation\Type;

class FlightGroup
{
    public function __construct(

        public string $token,

        /** @var list<Itinerary> */
        #[Type('list<'.Itinerary::class.'>')]
        public array $itineraries,

    ) {
    }
}
