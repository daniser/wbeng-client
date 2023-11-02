<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Query;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use TTBooking\WBEngine\DTO\Common\Carrier;
use TTBooking\WBEngine\DTO\Common\Code3D;
use TTBooking\WBEngine\DTO\Common\RouteSegment;
use TTBooking\WBEngine\DTO\Common\Seat;
use TTBooking\WBEngine\DTO\Enums\FlightSorting;
use TTBooking\WBEngine\DTO\Enums\ServiceClass;

class Parameters
{
    public function __construct(
        /** @var list<RouteSegment> */
        #[Assert\NotBlank]
        #[Assert\Valid]
        #[Type('list<'.RouteSegment::class.'>')]
        public array $route,

        /** @var list<Seat> */
        #[Assert\Count(min: 1, max: 9)]
        #[Assert\Valid]
        #[Type('list<'.Seat::class.'>')]
        public array $seats = [new Seat],

        public ServiceClass $serviceClass = ServiceClass::Economy,

        public ?bool $skipConnected = null,

        /** @deprecated */
        public ?bool $eticketsOnly = null,

        /** @deprecated */
        public ?bool $mixedVendors = null,

        /** @var null|list<Carrier> */
        #[Assert\Valid]
        #[Type('list<'.Carrier::class.'>')]
        public ?array $preferredAirlines = null,

        /** @var null|list<Carrier> */
        #[Assert\Valid]
        #[Type('list<'.Carrier::class.'>')]
        public ?array $ignoredAirlines = null,

        /** @var null|list<string> */
        #[Type('list<string>')]
        public ?array $preferredFlights = null,

        public ?Code3D $code3D = null,

        public ?FlightSorting $sort = null,

        #[Assert\Positive]
        public ?int $limit = null,
    ) {}
}
