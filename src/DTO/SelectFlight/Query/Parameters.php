<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SelectFlight\Query;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Attributes\SerializedPath;
use TTBooking\WBEngine\DTO\Common\CorporateID;
use TTBooking\WBEngine\DTO\Common\Query\FlightGroup;

class Parameters
{
    public function __construct(
        public string $token,

        /** @var list<FlightGroup> */
        #[SerializedPath('[flightGroups]', ['legacy' => '[flightsGroup][flightGroup]'])]
        #[Type('list<'.FlightGroup::class.'>')]
        public array $flightGroups,

        public ?CorporateID $corporateID = null,
    ) {}
}
