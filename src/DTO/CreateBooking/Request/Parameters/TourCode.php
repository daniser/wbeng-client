<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking\Request\Parameters;

use TTBooking\WBEngine\DTO\Common\Carrier;

class TourCode
{
    public function __construct(
        public string $code,

        public Carrier $carrier,
    ) {}
}
