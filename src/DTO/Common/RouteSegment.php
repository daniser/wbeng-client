<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use TTBooking\WBEngine\Builders;

class RouteSegment
{
    use Builders\RouteSegment;

    public function __construct(
        #[Assert\Valid]
        public Location $locationBegin,

        #[Assert\Valid]
        public Location $locationEnd,

        #[Type('DateTimeInterface<"Y-m-d">')]
        public DateTimeInterface $date,
    ) {}
}
