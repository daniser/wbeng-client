<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights\Response;

use TTBooking\WBEngine\DTO\Air\Enums\MessageSource;
use TTBooking\WBEngine\DTO\Air\Enums\MessageType;

class Message
{
    public function __construct(

        public MessageType $type,

        public MessageSource $source,

        public string $message,

    ) {
    }
}
