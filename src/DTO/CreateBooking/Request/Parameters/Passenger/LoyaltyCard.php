<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking\Request\Parameters\Passenger;

use TTBooking\WBEngine\DTO\Common\Carrier;

class LoyaltyCard
{
    public function __construct(
        public string $id,

        public Carrier $carrier,
    ) {}
}
