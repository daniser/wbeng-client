<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common\Response\Context;
use TTBooking\WBEngine\DTO\Common\Response\Message;

class Response
{
    public string $token;

    /** @var list<Message> */
    #[Type('list<'.Message::class.'>')]
    public array $messages = [];

    public Context $context;

    /** @var list<Response\FlightGroup> */
    #[Type('list<'.Response\FlightGroup::class.'>')]
    public array $flightGroups;

    /** @deprecated */
    public ?string $initTime;
}
