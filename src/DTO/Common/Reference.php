<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use TTBooking\WBEngine\DTO\Enums\ReferenceType;

class Reference
{
    public function __construct(
        public ReferenceType $type,

        public string $value,
    ) {}
}
