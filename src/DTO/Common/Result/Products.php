<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;

class Products
{
    public function __construct(
        /** @var list<AirTicket> */
        #[Type('list<'.AirTicket::class.'>')]
        public array $airTicket,

        /** @var list<EmdTicket> */
        #[Type('list<'.EmdTicket::class.'>')]
        public array $emdTicket,
    ) {}
}
