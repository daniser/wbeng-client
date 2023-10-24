<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum RespondType: string
{
    case JSON = 'JSON';
    case XML = 'XML';
}
