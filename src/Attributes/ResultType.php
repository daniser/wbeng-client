<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Attributes;

use Attribute;
use TTBooking\WBEngine\ResultInterface;

/**
 * @template TResult of ResultInterface
 */
#[Attribute(Attribute::TARGET_CLASS)]
class ResultType
{
    /**
     * @param class-string<TResult> $type
     */
    public function __construct(public string $type) {}
}
