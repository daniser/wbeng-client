<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response\FlightGroup\Itinerary\Flight\Segment;

use JMS\Serializer\Annotation\Type;

class Baggage
{
    public function __construct(
        public ?string $type,

        public ?string $allow,

        public string $value,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $descriptions,
    ) {}
}
