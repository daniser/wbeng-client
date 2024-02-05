<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking\Query;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\DTO\Common\Query\FlightGroup;
use TTBooking\WBEngine\Serializers\Symfony\Attribute\SerializedPath;

class Parameters
{
    public function __construct(
        public string $token,

        /** @var list<FlightGroup> */
        #[SerializedPath('[flightsGroup][flightGroup]')]
        #[Type('list<'.FlightGroup::class.'>')]
        public array $flightGroups,

        public Common\Customer $customer,

        /** @var list<Common\Passenger> */
        #[SerializedPath('[passengers][passenger]')]
        #[Type('list<'.Common\Passenger::class.'>')]
        public array $passengers,

        public Common\TourCode $tourCode,

        public Common\BenefitCode $benefitCode,

        public Common\Code3D $code3D,

        public ?bool $isHealthChecked = null,
    ) {}
}
