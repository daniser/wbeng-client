<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\DTO\Enums\LocomotionMethod;
use TTBooking\WBEngine\DTO\Enums\ServiceClass;
use TTBooking\WBEngine\Normalizer\CaseInsensitiveBackedEnumDenormalizer;
use TTBooking\WBEngine\Normalizer\TerminalDenormalizer;

class Segment
{
    public function __construct(
        public string $token,

        #[Context(denormalizationContext: [CaseInsensitiveBackedEnumDenormalizer::UPPERCASE_BACKED_ENUM => true])]
        public ServiceClass $serviceClass,

        public string $bookingClass,

        public string $fareBasis,

        public string $brandName,

        public Common\Carrier $carrier,

        public Common\Carrier $marketingCarrier,

        public Common\Carrier $operatingCarrier,

        public Common\Equipment $equipment,

        public LocomotionMethod $methLocomotion,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $dateBegin,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $dateEnd,

        public string $flightNumber,

        #[Context(denormalizationContext: [TerminalDenormalizer::STRING_TERMINAL_TO_ARRAY => true])]
        public ?Common\Terminal $terminalBegin,

        public Common\Location $locationBegin,

        public Common\City $cityBegin,

        public Common\Country $countryBegin,

        #[Context(denormalizationContext: [TerminalDenormalizer::STRING_TERMINAL_TO_ARRAY => true])]
        public ?Common\Terminal $terminalEnd,

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
