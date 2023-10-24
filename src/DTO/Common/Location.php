<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use Symfony\Component\Validator\Constraints as Assert;

class Location
{
    public function __construct(
        #[Assert\Length(exactly: 3)]
        public string $code,

        public string $name = '',
    ) {}
}
