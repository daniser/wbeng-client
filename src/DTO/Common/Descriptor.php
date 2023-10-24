<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

abstract class Descriptor
{
    public function __construct(
        public string $code,

        public string $name,
    ) {}
}
