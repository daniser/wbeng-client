<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Attributes\SerializedPath;
use TTBooking\WBEngine\DTO\Common\Result\Context;
use TTBooking\WBEngine\DTO\Common\Result\Message;
use TTBooking\WBEngine\ResultInterface;

class Result implements ResultInterface
{
    public string $token;

    /** @var list<Message> */
    #[SerializedPath('[messages]', ['legacy' => '[messages][message]'])]
    #[Type('list<'.Message::class.'>')]
    public array $messages = [];

    public Context $context;

    /** @var list<Result\FlightGroup> */
    #[SerializedPath('[flightGroups]', ['legacy' => '[flightsGroup][flightGroup]'])]
    #[Type('list<'.Result\FlightGroup::class.'>')]
    public array $flightGroups;

    /** @deprecated */
    public ?string $initTime;
}
