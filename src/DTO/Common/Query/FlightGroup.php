<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Query;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\Normalizer\LegacyNormalizer;

class FlightGroup
{
    public function __construct(
        public string $token,

        /** @var list<Itinerary> */
        #[Context([LegacyNormalizer::PATH => '[itineraries][itinerary]'])]
        #[Type('list<'.Itinerary::class.'>')]
        public array $itineraries,
    ) {}
}
