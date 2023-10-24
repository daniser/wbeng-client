<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking\Request\Parameters;

class Code3D
{
    public function __construct(

        public string $code = '',

        public int $percent = 0,

    ) {
    }
}
