<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use Symfony\Component\Validator\Constraints as Assert;

class Carrier
{
    public function __construct(
        #[Assert\Length(exactly: 2)]
        public string $code,

        public string $name = '',
    ) {}
}
