<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\DTO\Enums\ServiceClass;

class Segment
{
    public function __construct(
        public string $token,

        public ServiceClass $serviceClass,

        public string $bookingClass,

        public string $fareBasis,

        public string $brandName,

        public Common\Carrier $carrier,

        public Common\Carrier $marketingCarrier,

        public Common\Carrier $operatingCarrier,

        public Common\Equipment $equipment,

        public string $methLocomotion,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $dateBegin,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $dateEnd,

        public string $flightNumber,

        public string $terminalBegin,

        public Common\Location $locationBegin,

        public Common\City $cityBegin,

        public Common\Country $countryBegin,

        public string $terminalEnd,

        public Common\Location $locationEnd,

        public Common\City $cityEnd,

        public Common\Country $countryEnd,

        public bool $starting,

        public bool $connected,

        public int $travelDuration,

        public Segment\Baggage $baggage,

        public Segment\Baggage $carryOn,

        public string $regLocator,

        /** @var list<Segment\Landing> */
        #[Type('list<'.Segment\Landing::class.'>')]
        public array $landings,

        public ?string $seatsLeft,

        public ?Segment\DateSplit $dateSplit,
    ) {}
}
