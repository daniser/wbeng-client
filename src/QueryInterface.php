<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use TTBooking\WBEngine\DTO\Common\Query\Context;

/**
 * @template TResult of ResultInterface
 */
interface QueryInterface
{
    public function getEndpoint(): string;

    /**
     * @return class-string<TResult>
     */
    public function getResultType(): string;

    public function withContext(Context $context): static;
}
