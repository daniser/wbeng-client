<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\SerializedPath;

class Itinerary
{
    public function __construct(
        /** @var list<Flight> */
        #[SerializedPath('[flights][flight]')]
        #[Type('list<'.Flight::class.'>')]
        public array $flights,
    ) {}
}
