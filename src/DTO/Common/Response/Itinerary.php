<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response;

use JMS\Serializer\Annotation\Type;

class Itinerary
{
    public function __construct(
        /** @var list<Flight> */
        #[Type('list<'.Flight::class.'>')]
        public array $flights,
    ) {}
}
