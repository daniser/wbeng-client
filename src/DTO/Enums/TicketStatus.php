<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum TicketStatus: string
{
    case Booking = 'BOOKING';
    case Sell = 'SELL';
    case Refund = 'REFUND';
}
