<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Query;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Attributes\SerializedPath;

class Parameters
{
    public function __construct(
        public string $token,

        /** @var list<FlightGroup> */
        #[SerializedPath('[flightGroups]', ['legacy' => '[flightsGroup][flightGroup]'])]
        #[Type('list<'.FlightGroup::class.'>')]
        public array $flightGroups,
    ) {}
}
