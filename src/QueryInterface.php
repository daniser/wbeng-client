<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use TTBooking\WBEngine\DTO\Common\Query\Context;

/**
 * @template TResult of ResultInterface
 */
interface QueryInterface
{
    public function withContext(Context $context): static;

    public static function getEndpoint(): string;

    /**
     * @return class-string<TResult>
     */
    public static function getResultType(): string;
}
