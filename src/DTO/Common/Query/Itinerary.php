<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Query;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Serializers\Symfony\Attribute\SerializedPath;

class Itinerary
{
    public function __construct(
        public string $token,

        /** @var list<Flight> */
        #[SerializedPath('[flights][flight]')]
        #[Type('list<'.Flight::class.'>')]
        public array $flights,
    ) {}
}
