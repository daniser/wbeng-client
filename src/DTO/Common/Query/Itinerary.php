<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Query;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\SerializedPath;

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
