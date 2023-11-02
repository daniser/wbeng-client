<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\FlightFares;

use TTBooking\WBEngine\Attributes\Endpoint;
use TTBooking\WBEngine\Attributes\ResultType;
use TTBooking\WBEngine\DTO\Common\Query\Context;
use TTBooking\WBEngine\DTO\Common\Query\Parameters;
use TTBooking\WBEngine\QueryAttributes;
use TTBooking\WBEngine\QueryInterface;

/**
 * @implements QueryInterface<Result>
 */
#[Endpoint('flightfares')]
#[ResultType(Result::class)]
class Query implements QueryInterface
{
    use QueryAttributes;

    public function __construct(
        public Context $context,

        public Parameters $parameters,

        public ?string $provider = null,

        public ?string $gds = null,
    ) {}
}
