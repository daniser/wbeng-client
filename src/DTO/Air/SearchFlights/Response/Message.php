<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\SearchFlights\Response;

class Message
{
    public function __construct(

        public string $type,

        public string $source,

        public string $message,

    ) {
    }
}
