<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\Common;

abstract class Descriptor
{
    public function __construct(

        public string $code,

        public string $name,

    ) {
    }
}
