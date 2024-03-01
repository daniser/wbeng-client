<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use TTBooking\WBEngine\Functional\{an, is};

/**
 * @method static bool isComplete()
 */
trait StaticallyCallable
{
    /**
     * @param list<mixed> $arguments
     */
    public static function __callStatic(string $name, array $arguments): mixed
    {
        return an\entity(static::class)->$name(...$arguments);
    }

    public function isComplete(): bool
    {
        return is\complete($this);
    }
}
