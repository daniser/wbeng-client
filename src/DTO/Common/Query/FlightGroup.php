<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Query;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Attributes\SerializedPath;

class FlightGroup
{
    public function __construct(
        public string $token,

        /** @var list<Itinerary> */
        #[SerializedPath('[itineraries][itinerary]')]
        #[Type('list<'.Itinerary::class.'>')]
        public array $itineraries,
    ) {}
}
