<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\Common\Request;

use JMS\Serializer\Annotation\Type;

class Parameters
{
    public function __construct(

        public string $token,

        /** @var list<FlightGroup> */
        #[Type('list<'.FlightGroup::class.'>')]
        public array $flightsGroup,

    ) {
    }
}
