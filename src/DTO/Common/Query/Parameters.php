<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Query;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Serializers\Symfony\Attribute\SerializedPath;

class Parameters
{
    public function __construct(
        public string $token,

        /** @var list<FlightGroup> */
        #[SerializedPath('[flightsGroup][flightGroup]')]
        #[Type('list<'.FlightGroup::class.'>')]
        public array $flightGroups,
    ) {}
}
