<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response\FlightGroup\Fares\FareSeat;

class Price
{
    public function __construct(

        public int $amount,

        public string $currency,

        public int $rate,

        public int $amountBase,

        public string $currencyBase,

        public string $elementType,

        public string $code,

    ) {
    }
}
