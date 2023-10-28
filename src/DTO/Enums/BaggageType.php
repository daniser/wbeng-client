<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum BaggageType: string
{
    case Piece = 'PC';
    case Kilogram = 'KG';
}
