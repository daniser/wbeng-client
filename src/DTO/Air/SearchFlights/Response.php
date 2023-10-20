<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Air\Common\ResponseContext;

class Response
{
    public function __construct(

        public string $token,

        /** @var list<Response\Message> */
        #[Type('list<App\DataTransferObjects\Air\SearchFlights\Response\Message>')]
        public array $messages,

        public ResponseContext $context,

        /** @var list<Response\FlightGroup> */
        #[Type('list<App\DataTransferObjects\Air\SearchFlights\Response\FlightGroup>')]
        public array $flightGroups,

    ) {
    }
}
