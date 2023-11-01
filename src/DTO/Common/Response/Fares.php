<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\SerializedPath;

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
