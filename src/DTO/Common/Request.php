<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

class Request
{
    public function __construct(
        public Request\Context $context,

        public Request\Parameters $parameters,
    ) {}
}
