<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response;

use JMS\Serializer\Annotation\Type;

class Flight
{
    public function __construct(
        public string $token,

        /** @var list<Segment> */
        #[Type('list<'.Segment::class.'>')]
        public array $segments,

        public int $travelDuration,

        public int|string $seatsAvailable,
    ) {}
}
