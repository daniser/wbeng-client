<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SelectFlight;

use TTBooking\WBEngine\Attributes\Endpoint;
use TTBooking\WBEngine\Attributes\ResultType;
use TTBooking\WBEngine\Builders\SelectFlight;
use TTBooking\WBEngine\DTO\Common\Query\Context;
use TTBooking\WBEngine\DTO\Common\Result;
use TTBooking\WBEngine\QueryInterface;

/**
 * @implements QueryInterface<Result>
 */
#[Endpoint('price')]
#[ResultType(Result::class)]
class Query implements QueryInterface
{
    /** @use SelectFlight<Result> */
    use SelectFlight;

    public function __construct(
        public Context $context,

        public Query\Parameters $parameters,

        public ?string $provider = null,

        public ?string $gds = null,
    ) {}
}
