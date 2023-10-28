<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SelectFlight;

use TTBooking\WBEngine\DTO\Common\Request\Context;

class Request
{
    public function __construct(
        public Context $context,

        public Request\Parameters $parameters,

        public ?string $provider = null,

        public ?string $gds = null,
    ) {}
}