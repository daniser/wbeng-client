<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SelectFlight\Query;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\DTO\Common\CorporateID;
use TTBooking\WBEngine\DTO\Common\Query\FlightGroup;
use TTBooking\WBEngine\Normalizer\LegacyNormalizer;

class Parameters
{
    public function __construct(
        public string $token,

        /** @var list<FlightGroup> */
        #[Context([LegacyNormalizer::PATH => '[flightsGroup][flightGroup]'])]
        #[Type('list<'.FlightGroup::class.'>')]
        public array $flightGroups,

        public ?CorporateID $corporateID = null,
    ) {}
}
