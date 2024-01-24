<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\Normalizer\LegacyNormalizer;

class Itinerary
{
    public function __construct(
        /** @var list<Flight> */
        #[Context([LegacyNormalizer::PATH => '[flights][flight]'])]
        #[Type('list<'.Flight::class.'>')]
        public array $flights,
    ) {}
}
