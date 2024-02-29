<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking;

use Symfony\Component\Validator\Constraints as Assert;
use TTBooking\WBEngine\Attributes\Endpoint;
use TTBooking\WBEngine\Attributes\ResultType;
use TTBooking\WBEngine\Builders\CreateBooking;
use TTBooking\WBEngine\DTO\Common\Query\Context;
use TTBooking\WBEngine\QueryInterface;

/**
 * @implements QueryInterface<Result>
 */
#[Endpoint('book')]
#[ResultType(Result::class)]
class Query implements QueryInterface
{
    /** @use CreateBooking<Result> */
    use CreateBooking;

    public function __construct(
        public Context $context,

        #[Assert\Valid]
        public Query\Parameters $parameters,

        public ?string $provider = null,

        public ?string $gds = null,
    ) {}
}
