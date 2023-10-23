<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Air\Common\Response\Context;

class Response
{
    public function __construct(

        public string $token,

        /** @var list<Response\Message> */
        #[Type('list<'.Response\Message::class.'>')]
        public array $messages,

        public Context $context,

        /** @var list<Response\FlightGroup> */
        #[Type('list<'.Response\FlightGroup::class.'>')]
        public array $flightGroups,

    ) {
    }
}
