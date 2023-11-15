<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use Symfony\Component\Validator\Constraints as Assert;

class Terminal
{
    public function __construct(
        #[Assert\Length(exactly: 1)]
        public string $code,

        public string $name = '',
    ) {}
}
