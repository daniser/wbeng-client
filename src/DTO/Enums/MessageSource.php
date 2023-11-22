<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum MessageSource: string
{
    case Request = 'REQUEST';
    case Build = 'BUILD';
    case Operation = 'OPERATION';
    case Provider = 'PROVIDER';
    case Parallel = 'PARALLEL';
}
