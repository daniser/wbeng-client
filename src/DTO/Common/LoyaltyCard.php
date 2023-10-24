<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

class LoyaltyCard
{
    public function __construct(
        public string $id,

        public Carrier $carrier,
    ) {}
}
