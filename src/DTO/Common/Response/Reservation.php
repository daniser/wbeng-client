<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;

class Reservation
{
    public function __construct(
        public string $token,

        public string $recordLocator,

        public string $regLocator,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $date,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $timeLimit,

        public Products $products,

        public bool $isExtraTicket,
    ) {}
}
