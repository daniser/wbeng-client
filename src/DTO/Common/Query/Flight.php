<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Query;

class Flight
{
    public function __construct(
        public string $token,
    ) {}
}
