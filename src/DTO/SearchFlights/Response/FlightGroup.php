<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common;

class FlightGroup
{
    public function __construct(
        public string $token,

        public string $aggregator,

        public Common\Carrier $carrier,

        public bool $eticket,

        public bool $latinRegistration,

        public string $timeLimit,

        public string $gds,

        public string $terminal,

        public ?bool $allowSSC,

        public bool $allow3D,

        public bool $allowBookWithAncillary,

        public bool $allowBookWithAccompany,

        /** @var list<FlightGroup\Itinerary> */
        #[Type('list<'.FlightGroup\Itinerary::class.'>')]
        public array $itineraries,

        public FlightGroup\Fares $fares,

        public bool $isCharter,

        public bool $isLowcost,

        public bool $isSpecial,

        public bool $isHealthCheckRequired,

        public bool $isTourOperator,

        public bool $virtualInterlining,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $officeReference,

        public string $provider,

        public string $localPriority,
    ) {}
}
