<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response\Fares\FareSeat;

class Vat
{
    public function __construct(
        public string $code,

        public int $amount,

        public int $percent,

        public float $rate,

        public string $currency,

        public int $amountBase,

        public string $currencyBase,
    ) {}
}
