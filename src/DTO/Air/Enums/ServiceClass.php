<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\Enums;

enum ServiceClass: string
{
    case Economy = 'ECONOMY';
    case Business = 'BUSINESS';
    case First = 'FIRST';
    case Premium = 'PREMIUM';
    case PremiumEconomy = 'PREMIUMECONOMY';
}
