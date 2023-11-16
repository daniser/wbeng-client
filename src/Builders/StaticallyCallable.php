<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use TTBooking\WBEngine\Functional\an;

trait StaticallyCallable
{
    public static function __callStatic(string $name, array $arguments): mixed
    {
        return an\entity(static::class)->$name(...$arguments);
    }
}
