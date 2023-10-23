<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\CreateBooking\Request\Parameters\Passenger;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Air\Common;
use TTBooking\WBEngine\DTO\Air\Enums\Gender;

class Passport
{
    public function __construct(

        public string $firstName,

        public string $lastName,

        public ?string $middleName,

        public Common\Country $citizenship,

        public Common\Country $issueCountry,

        #[Type('DateTimeInterface<"Y-m-d">')]
        public \DateTimeInterface $issued,

        #[Type('DateTimeInterface<"Y-m-d">')]
        public \DateTimeInterface $expired,

        public string $number,

        public string $type,

        #[Type('DateTimeInterface<"Y-m-d">')]
        public \DateTimeInterface $birthday,

        public Gender $gender,

    ) {
    }
}
