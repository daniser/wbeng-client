<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking\Request\Parameters;

class Customer
{
    public function __construct(
        public string $name,

        public string $email,

        public string $countryCode,

        public string $areaCode,

        public string $phoneNumber,
    ) {}
}
