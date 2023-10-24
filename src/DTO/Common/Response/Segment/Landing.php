<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response\Segment;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common\Location;

class Landing
{
    public function __construct(
        public Location $locationCode,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $dateBegin,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $dateEnd,
    ) {}
}
