<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\CreateBooking;

use TTBooking\WBEngine\DTO\Air\Common\Request\Context;

class Request
{
    public function __construct(

        public Context $context,

        public Request\Parameters $parameters,

    ) {
    }
}
