<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum MessageType: string
{
    case Info = 'INFO';
    case Notice = 'NOTICE';
    case Warning = 'WARNING';
    case Error = 'ERROR';
    case Debug = 'DEBUG';
    case ForUser = 'FORUSER';

    public function style(): string
    {
        return match ($this) {
            self::Info => 'bg=cyan;fg=black',
            self::Notice => 'bg=green;fg=black',
            self::Warning => 'bg=yellow;fg=black',
            self::Error => 'error',
            self::Debug => 'bg=magenta',
            self::ForUser => 'bg=cyan;fg=white',
        };
    }
}
