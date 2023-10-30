<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use Symfony\Component\Validator\Constraints as Assert;
use TTBooking\WBEngine\DTO\Enums\PassengerType;

class Seat
{
    public function __construct(
        public PassengerType $passengerType = PassengerType::Adult,

        #[Assert\Positive]
        public int $count = 1,
    ) {}
}
