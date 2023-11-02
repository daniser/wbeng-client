<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SelectFlight\Request;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\SerializedPath;
use TTBooking\WBEngine\DTO\Common\CorporateID;
use TTBooking\WBEngine\DTO\Common\Request\FlightGroup;

class Parameters
{
    public function __construct(
        public string $token,

        /** @var list<FlightGroup> */
        #[SerializedPath('[flightsGroup][flightGroup]')]
        #[Type('list<'.FlightGroup::class.'>')]
        public array $flightGroups,

        public ?CorporateID $corporateID = null,
    ) {}
}
