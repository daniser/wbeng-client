<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum BookingStatus: string
{
    case New = 'NEW';
    case Complete = 'COMPLETE';
    case Cancelled = 'CANCELLED';
    case Refund = 'REFUND';
}
