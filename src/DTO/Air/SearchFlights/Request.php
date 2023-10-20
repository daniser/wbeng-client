<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights;

use TTBooking\WBEngine\DTO\Air\Common\RequestContext;

class Request
{
    public function __construct(

        public RequestContext $context,

        public Request\Parameters $parameters,

    ) {
    }
}
