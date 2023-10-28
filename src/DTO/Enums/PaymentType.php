<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum PaymentType: string
{
    case Cash = 'CASH';
    case Invoice = 'INVOICE';
}
