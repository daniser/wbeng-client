<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights;

use TTBooking\WBEngine\Attributes\Endpoint;
use TTBooking\WBEngine\Attributes\ResultType;
use TTBooking\WBEngine\Builders\SearchFlights;
use TTBooking\WBEngine\DTO\Common\Query\Context;
use TTBooking\WBEngine\DTO\Common\Result;
use TTBooking\WBEngine\QueryAttributes;
use TTBooking\WBEngine\QueryInterface;

/**
 * @implements QueryInterface<Result>
 */
#[Endpoint('flights')]
#[ResultType(Result::class)]
class Query implements QueryInterface
{
    use QueryAttributes, SearchFlights;

    public function __construct(
        public Context $context,

        public Query\Parameters $parameters,
    ) {}
}
