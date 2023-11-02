<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use TTBooking\WBEngine\DTO\Enums\MessageSource;
use TTBooking\WBEngine\DTO\Enums\MessageType;

class Message
{
    public MessageType $type;

    public ?MessageSource $source = null;

    public int $code;

    public string $message;
}
