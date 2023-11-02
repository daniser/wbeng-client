<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result\Segment;

class DateSplit
{
    public function __construct(
        public DateAndTime $departure,

        public DateAndTime $arrival,
    ) {}
}
