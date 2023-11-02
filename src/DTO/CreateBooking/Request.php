<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking;

use TTBooking\WBEngine\Attributes\Endpoint;
use TTBooking\WBEngine\Attributes\ResultType;
use TTBooking\WBEngine\DTO\Common\Request\Context;
use TTBooking\WBEngine\QueryAttributes;
use TTBooking\WBEngine\QueryInterface;

/**
 * @implements QueryInterface<Response>
 */
#[Endpoint('book')]
#[ResultType(Response::class)]
class Request implements QueryInterface
{
    use QueryAttributes;

    public function __construct(
        public Context $context,

        public Request\Parameters $parameters,

        public ?string $provider = null,

        public ?string $gds = null,
    ) {}
}
