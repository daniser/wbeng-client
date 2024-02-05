<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common\Result\Context;
use TTBooking\WBEngine\DTO\Common\Result\Message;
use TTBooking\WBEngine\ResultInterface;
use TTBooking\WBEngine\Serializers\Symfony\Attribute\SerializedPath;

class Result implements ResultInterface
{
    public string $token;

    /** @var list<Message> */
    #[SerializedPath('[messages][message]')]
    #[Type('list<'.Message::class.'>')]
    public array $messages = [];

    public Context $context;

    /** @var list<Result\FlightGroup> */
    #[SerializedPath('[flightsGroup][flightGroup]')]
    #[Type('list<'.Result\FlightGroup::class.'>')]
    public array $flightGroups;

    /** @deprecated */
    public ?string $initTime;
}
