<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking\Query;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\SerializedPath;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\DTO\Common\Query\FlightGroup;

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
