<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SelectFlight\Request;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Builders;
use TTBooking\WBEngine\DTO\Common\CorporateID;
use TTBooking\WBEngine\DTO\Common\Request\FlightGroup;

class Parameters
{
    use Builders\SelectFlight;

    public function __construct(
        public string $token,

        /** @var list<FlightGroup> */
        #[Type('list<'.FlightGroup::class.'>')]
        public array $flightsGroup,

        public ?CorporateID $corporateID = null,
    ) {}
}
