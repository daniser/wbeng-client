<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\CreateBooking\Request\Parameters\Passenger;

use TTBooking\WBEngine\DTO\Air\Common\Carrier;

class LoyaltyCard
{
    public function __construct(

        public string $id,

        public Carrier $carrier,

    ) {
    }
}
