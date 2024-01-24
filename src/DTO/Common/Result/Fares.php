<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\Normalizer\LegacyNormalizer;

class Fares
{
    public function __construct(
        public Fares\FareDesc $fareDesc,

        /** @var list<Fares\FareSeat> */
        #[Context([LegacyNormalizer::PATH => '[fareSeats][fareSeat]'])]
        #[Type('list<'.Fares\FareSeat::class.'>')]
        public array $fareSeats,

        #[Context([LegacyNormalizer::PATH => '[fareTotal][total]'])]
        public int $fareTotal,

        public Fares\FareTotalOriginal $fareTotalOriginal,
    ) {}
}
