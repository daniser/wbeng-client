<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights\Request\Parameters;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use TTBooking\WBEngine\DTO\Air\Common;

class RouteSegment
{
    public function __construct(

        #[Assert\Valid]
        public Common\Location $locationBegin,

        #[Assert\Valid]
        public Common\Location $locationEnd,

        #[Type('DateTimeInterface<"Y-m-d">')]
        public \DateTimeInterface $date,

    ) {
    }
}
