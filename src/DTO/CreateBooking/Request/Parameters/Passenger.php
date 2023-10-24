<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking\Request\Parameters;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Enums\PassengerType;
use TTBooking\WBEngine\DTO\Enums\PhoneType;

class Passenger
{
    public function __construct(

        public string $token,

        public Passenger\Passport $passport,

        public Passenger\LoyaltyCard $loyaltyCard,

        public PassengerType $type,

        public PhoneType $phoneType,

        public string $phoneNumber,

        public string $countryCode,

        public string $areaCode,

        public ?string $tariff,

        public string $railwayBonusCardNumber,

        public string $email,

        public bool $isEmailRefused = false,

        public bool $isEmailAbsent = false,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $extraDocuments = [],

    ) {
    }
}
