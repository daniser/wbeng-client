<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use TTBooking\WBEngine\DTO\Enums\OfficeReferenceType;

class OfficeReference
{
    public function __construct(
        public string $value,

        public OfficeReferenceType $type,
    ) {}
}
