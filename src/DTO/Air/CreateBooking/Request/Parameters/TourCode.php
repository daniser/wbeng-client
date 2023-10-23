<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\CreateBooking\Request\Parameters;

use TTBooking\WBEngine\DTO\Air\Common\Carrier;

class TourCode
{
    public function __construct(

        public string $code,

        public Carrier $carrier,

    ) {
    }
}
