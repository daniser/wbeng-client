<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum FlightSorting: string
{
    case Price = 'price';
    case Duration = 'duration';
}
