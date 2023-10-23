<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\Common\Request;

use JMS\Serializer\Annotation\Type;

class Itinerary
{
    public function __construct(

        public string $token,

        /** @var list<Flight> */
        #[Type('list<'.Flight::class.'>')]
        public array $flights,

    ) {
    }
}
