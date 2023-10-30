<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common;

class FlightGroup
{
    public function __construct(
        public string $token,

        /** @deprecated */
        public ?string $aggregator,

        public Common\Carrier $carrier,

        /** @deprecated */
        public ?bool $eticket,

        public bool $latinRegistration,

        public DateTimeInterface $timeLimit,

        public string $gds,

        public ?string $terminal,

        public ?bool $allowSSC,

        public bool $allow3D,

        /** @var list<Itinerary> */
        #[Type('list<'.Itinerary::class.'>')]
        public array $itineraries,

        public Fares $fares,

        public string $provider,

        /** @deprecated */
        public ?bool $untouchable,

        public bool $isCharter,

        public bool $isSpecial,

        public bool $isLowcost,

        public bool $isHealthCheckRequired,

        public bool $isTourOperator,

        public bool $allowBookWithAccompany,

        public bool $allowBookWithAncillary,

        public bool $virtualInterlining,

        /** @var list<Common\OfficeReference> */
        #[Type('list<'.Common\OfficeReference::class.'>')]
        public array $officeReference,

        public string $localPriority,
    ) {}
}