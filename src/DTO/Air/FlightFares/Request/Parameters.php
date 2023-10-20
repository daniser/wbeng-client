<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\FlightFares\Request;

use JMS\Serializer\Annotation\Type;

class Parameters
{
    public function __construct(

        public string $token,

        /** @var list<FlightGroup> */
        #[Type('list<TTBooking\WBEngine\DTO\Air\FlightFares\Request\FlightGroup>')]
        public array $flightsGroup,

    ) {
    }
}
