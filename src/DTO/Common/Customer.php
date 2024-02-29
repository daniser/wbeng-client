<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;
use Symfony\Component\Validator\Constraints as Assert;

class Customer
{
    public function __construct(
        public string $name,

        #[Assert\Email(mode: Assert\Email::VALIDATION_MODE_STRICT)]
        public string $email,

        #[AssertPhoneNumber]
        public string $phone,
    ) {}
}
