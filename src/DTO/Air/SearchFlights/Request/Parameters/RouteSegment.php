<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights\Request\Parameters;

use TTBooking\WBEngine\DTO\Air\Common;
use JMS\Serializer\Annotation\Type;

class RouteSegment
{
    public function __construct(

        public Common\Location $locationBegin,

        public Common\Location $locationEnd,

        #[Type('DateTimeInterface<"Y-m-d">')]
        public \DateTimeInterface $date,

    ) {
    }
}
