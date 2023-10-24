<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response\FlightGroup;

use JMS\Serializer\Annotation\Type;

class Fares
{
    public function __construct(
        public Fares\FareDesc $fareDesc,

        /** @var list<Fares\FareSeat> */
        #[Type('list<'.Fares\FareSeat::class.'>')]
        public array $fareSeats,

        public int $fareTotal,

        public Fares\FareTotalOriginal $fareTotalOriginal,
    ) {}
}
