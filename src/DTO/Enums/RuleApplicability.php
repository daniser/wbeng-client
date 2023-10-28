<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum RuleApplicability: string
{
    case Before = 'BEFORE';
    case After = 'AFTER';
    case NA = 'N/A';
}
