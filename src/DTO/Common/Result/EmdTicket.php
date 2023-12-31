<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\DTO\Enums\TicketStatus;

class EmdTicket
{
    public function __construct(
        public string $token,

        public Common\Carrier $carrier,

        public int $eticket,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $issueDate,

        public string $recordLocator,

        public string $regLocator,

        public TicketStatus $status,

        public string $number,

        public string $exchangeNumber,

        public Common\Passenger $passenger,

        /** @var list<Itinerary> */
        #[Type('list<'.Itinerary::class.'>')]
        public array $itineraries,

        public Fares $fares,

        public Ancillary $ancillary,
    ) {}
}
