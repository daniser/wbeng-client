<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\SearchFlights\Response;

use TTBooking\WBEngine\DTO\Enums\MessageSource;
use TTBooking\WBEngine\DTO\Enums\MessageType;

class Message
{
    public function __construct(
        public MessageType $type,

        public MessageSource $source,

        public string $message,
    ) {}
}
