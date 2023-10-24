<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response\FlightGroup\Fares;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Enums\PassengerType;

class FareSeat
{
    public function __construct(
        public PassengerType $passengerType,

        public string $count,

        /** @var list<FareSeat\Price> */
        #[Type('list<'.FareSeat\Price::class.'>')]
        public array $prices,

        /** @var list<int> */
        #[Type('list<int>')]
        public array $vat,

        public int $total,
    ) {}
}
