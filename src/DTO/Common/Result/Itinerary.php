<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Attributes\SerializedPath;

class Itinerary
{
    public function __construct(
        /** @var list<Flight> */
        #[SerializedPath('[flights]', ['legacy' => '[flights][flight]'])]
        #[Type('list<'.Flight::class.'>')]
        public array $flights,
    ) {}
}
