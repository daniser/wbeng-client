<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum LocomotionMethod: string
{
    case Avia = 'AVIA';
    case Bus = 'BUS';
    case Train = 'TRAIN';
}
