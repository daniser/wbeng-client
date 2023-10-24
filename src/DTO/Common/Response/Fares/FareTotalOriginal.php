<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response\Fares;

class FareTotalOriginal
{
    public function __construct(
        public ?string $elementType,

        public int $amount,

        public string $currency,
    ) {}
}
