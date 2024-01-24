<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\DTO\Common\Result\Message;
use TTBooking\WBEngine\Normalizer\LegacyNormalizer;
use TTBooking\WBEngine\ResultInterface;

class Result implements ResultInterface
{
    public string $token;

    /** @var list<Message> */
    #[Context([LegacyNormalizer::PATH => '[messages][message]'])]
    #[Type('list<'.Message::class.'>')]
    public array $messages = [];

    public Result\Context $context;

    /** @var list<Result\FlightGroup> */
    #[Context([LegacyNormalizer::PATH => '[flightsGroup][flightGroup]'])]
    #[Type('list<'.Result\FlightGroup::class.'>')]
    public array $flightGroups;

    /** @deprecated */
    public ?string $initTime;
}
