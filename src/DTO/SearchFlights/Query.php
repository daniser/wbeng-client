<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights;

use Symfony\Component\Validator\Constraints as Assert;
use TTBooking\WBEngine\Attributes\Endpoint;
use TTBooking\WBEngine\Attributes\ResultType;
use TTBooking\WBEngine\Builders\SearchFlights;
use TTBooking\WBEngine\DTO\Common\Query\Context;
use TTBooking\WBEngine\DTO\Common\Result;
use TTBooking\WBEngine\QueryInterface;

/**
 * @implements QueryInterface<Result>
 */
#[Endpoint('flights')]
#[ResultType(Result::class)]
class Query implements QueryInterface
{
    /** @use SearchFlights<Result> */
    use SearchFlights;

    public function __construct(
        public Context $context,

        #[Assert\Valid]
        public Query\Parameters $parameters,
    ) {}
}
