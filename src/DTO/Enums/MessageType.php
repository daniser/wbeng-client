<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum MessageType: string
{
    case Debug = 'DEBUG';
    case Info = 'INFO';
    case Notice = 'NOTICE';
    case Warning = 'WARNING';
    case Error = 'ERROR';
    case ForUser = 'FORUSER';

    public function style(): string
    {
        return match ($this) {
            self::Debug => 'bg=magenta',
            self::Info => 'bg=blue',
            self::Notice => 'bg=green;fg=black',
            self::Warning => 'bg=yellow;fg=black',
            self::Error => 'error',
            self::ForUser => 'bg=cyan;fg=black',
        };
    }
}
