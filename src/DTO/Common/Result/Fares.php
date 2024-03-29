<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Serializers\Symfony\Attribute\SerializedPath;

class Fares
{
    public function __construct(
        public Fares\FareDesc $fareDesc,

        /** @var list<Fares\FareSeat> */
        #[SerializedPath('[fareSeats][fareSeat]')]
        #[Type('list<'.Fares\FareSeat::class.'>')]
        public array $fareSeats,

        #[SerializedPath('[fareTotal][total]')]
        public int $fareTotal,

        public Fares\FareTotalOriginal $fareTotalOriginal,
    ) {}
}
