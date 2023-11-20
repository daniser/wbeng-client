<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Builders;
use TTBooking\WBEngine\DTO\Enums\PassengerType;
use TTBooking\WBEngine\DTO\Enums\PhoneType;

class Passenger
{
    use Builders\Passenger;

    public function __construct(
        public string $token,

        public Passport $passport,

        public LoyaltyCard $loyaltyCard,

        public PassengerType $type,

        public PhoneType $phoneType,

        public string $phoneNumber,

        public string $countryCode,

        public string $areaCode,

        public ?string $tariff,

        public string $railwayBonusCardNumber,

        public ?string $email = null,

        public bool $isEmailRefused = false,

        public bool $isEmailAbsent = true,

        /** @var list<Document> */
        #[Type('list<'.Document::class.'>')]
        public array $extraDocuments = [],
    ) {}
}
