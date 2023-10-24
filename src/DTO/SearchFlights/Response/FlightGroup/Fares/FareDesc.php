<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response\FlightGroup\Fares;

use JMS\Serializer\Annotation\Type;

class FareDesc
{
    public function __construct(

        public FareDesc\Receipt $receipt,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $discounts,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $rules,

    ) {
    }
}
