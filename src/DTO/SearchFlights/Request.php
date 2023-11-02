<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights;

use TTBooking\WBEngine\Attributes\Endpoint;
use TTBooking\WBEngine\Attributes\ResultType;
use TTBooking\WBEngine\Builders\SearchFlights;
use TTBooking\WBEngine\DTO\Common\Request\Context;
use TTBooking\WBEngine\DTO\Common\Response;
use TTBooking\WBEngine\QueryAttributes;
use TTBooking\WBEngine\QueryInterface;

/**
 * @implements QueryInterface<Response>
 */
#[Endpoint('flights')]
#[ResultType(Response::class)]
class Request implements QueryInterface
{
    use QueryAttributes, SearchFlights;

    public function __construct(
        public Context $context,

        public Request\Parameters $parameters,
    ) {}
}
