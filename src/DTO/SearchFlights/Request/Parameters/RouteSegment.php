<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use TTBooking\WBEngine\Builders;
use TTBooking\WBEngine\DTO\Common;

class RouteSegment
{
    use Builders\RouteSegment;

    public function __construct(
        #[Assert\Valid]
        public Common\Location $locationBegin,

        #[Assert\Valid]
        public Common\Location $locationEnd,

        #[Type('DateTimeInterface<"Y-m-d">')]
        public DateTimeInterface $date,
    ) {}
}
