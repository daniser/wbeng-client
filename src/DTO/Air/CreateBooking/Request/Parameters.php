<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\CreateBooking\Request;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Air\Common\Request\FlightGroup;
use TTBooking\WBEngine\DTO\Air\CreateBooking\Request\Parameters\Code3D;

class Parameters
{
    public function __construct(

        public string $token,

        /** @var list<FlightGroup> */
        #[Type('list<'.FlightGroup::class.'>')]
        public array $flightsGroup,

        public Parameters\Customer $customer,

        /** @var list<Parameters\Passenger> */
        #[Type('list<'.Parameters\Passenger::class.'>')]
        public array $passengers,

        public Parameters\TourCode $tourCode,

        public Parameters\BenefitCode $benefitCode,

        public Parameters\Code3D $code3D = new Code3D,

        public ?bool $isHealthChecked = null,

    ) {
    }
}
