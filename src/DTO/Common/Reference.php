<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

class Reference
{
    public function __construct(
        public string $type,

        public string $value,
    ) {}
}
