<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\Common;

class Request
{
    public function __construct(

        public Request\Context $context,

        public Request\Parameters $parameters,

    ) {
    }
}
