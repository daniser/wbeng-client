<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum TicketType: string
{
    case All = 'ALL';
    case Tickets = 'ETK';
    case Misc = 'EMD';
}
