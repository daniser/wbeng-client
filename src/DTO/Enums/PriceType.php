<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum PriceType: string
{
    case Tariff = 'TARIFF';
    case Taxes = 'TAXES';
    case Discount = 'DISCOUNT';
    case SborSa = 'SBOR_SA';
    case DiscSa = 'DISC_SA';
    case ComisAg = 'COMIS_AG';
    case ComisSa = 'COMIS_SA';
    case SborFarf = 'SBOR_FARF';
    case Fee = 'FEE';
    case FeeDel = 'FEE_DEL';
    case Nds = 'NDS';
    case Penalty = 'PENALTY';
}
