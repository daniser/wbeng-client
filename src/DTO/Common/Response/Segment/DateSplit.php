<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response\Segment;

class DateSplit
{
    public function __construct(
        public DateAndTime $departure,

        public DateAndTime $arrival,
    ) {}
}
