<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\FlightFares;

use TTBooking\WBEngine\DTO\Common\Request\Context;
use TTBooking\WBEngine\DTO\Common\Request\Parameters;

class Request
{
    public function __construct(
        public Context $context,

        public Parameters $parameters,

        public string $provider,

        public string $gds,
    ) {}
}
