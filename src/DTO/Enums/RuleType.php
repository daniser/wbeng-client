<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum RuleType: string
{
    case Refund = 'REFUND';
    case Exchange = 'EXCHANGE';
}
