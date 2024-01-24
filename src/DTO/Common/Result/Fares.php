<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Attributes\SerializedPath;

class Fares
{
    public function __construct(
        public Fares\FareDesc $fareDesc,

        /** @var list<Fares\FareSeat> */
        #[SerializedPath('[fareSeats]', ['legacy' => '[fareSeats][fareSeat]'])]
        #[Type('list<'.Fares\FareSeat::class.'>')]
        public array $fareSeats,

        #[SerializedPath('[fareTotal]', ['legacy' => '[fareTotal][total]'])]
        public int $fareTotal,

        public Fares\FareTotalOriginal $fareTotalOriginal,
    ) {}
}
