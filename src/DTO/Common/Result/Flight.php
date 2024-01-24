<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\Normalizer\LegacyNormalizer;

class Flight
{
    public function __construct(
        public string $token,

        /** @var list<Segment> */
        #[Context([LegacyNormalizer::PATH => '[segments][segment]'])]
        #[Type('list<'.Segment::class.'>')]
        public array $segments,

        public ?int $travelDuration = null,

        public ?int $seatsAvailable = null,
    ) {}
}
