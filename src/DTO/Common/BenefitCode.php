<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

class BenefitCode
{
    public function __construct(
        public string $code,

        public Carrier $carrier,
    ) {}
}
