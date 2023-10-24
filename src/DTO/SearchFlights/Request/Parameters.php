<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Request;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;
use TTBooking\WBEngine\DTO\Enums\ServiceClass;

class Parameters
{
    public function __construct(

        /** @var list<Parameters\RouteSegment> */
        #[Assert\Valid]
        #[Type('list<'.Parameters\RouteSegment::class.'>')]
        public array $route = [],

        /** @var list<Parameters\Seat> */
        #[Type('list<'.Parameters\Seat::class.'>')]
        public array $seats = [new Parameters\Seat],

        public ServiceClass $serviceClass = ServiceClass::Economy,

        public bool $skipConnected = false,

        public bool $eticketsOnly = true,

        public bool $mixedVendors = true,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $preferredAirlines = [],

    ) {
    }
}
