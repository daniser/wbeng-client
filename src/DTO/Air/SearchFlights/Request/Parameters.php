<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights\Request;

use TTBooking\WBEngine\DTO\Air\Enums\ServiceClass;
use JMS\Serializer\Annotation\Type;

class Parameters
{
    public function __construct(

        /** @var list<Parameters\RouteSegment> */
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
