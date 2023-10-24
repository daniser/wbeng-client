<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum MessageSource: string
{
    case Build = 'BUILD';
    case Provider = 'PROVIDER';
}
