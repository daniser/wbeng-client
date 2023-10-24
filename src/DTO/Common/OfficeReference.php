<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

class OfficeReference
{
    public function __construct(
        public string $value,

        public string $type,
    ) {}
}
