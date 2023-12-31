<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result\Segment;

class DateAndTime
{
    public function __construct(
        public string $date,

        public string $time,
    ) {}
}
