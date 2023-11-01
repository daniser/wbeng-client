<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response\Fares;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\SerializedPath;
use TTBooking\WBEngine\DTO\Enums\PassengerType;

class FareSeat
{
    public function __construct(
        public PassengerType $passengerType,

        public int $count,

        /** @var list<FareSeat\Price> */
        #[SerializedPath('[prices][price]')]
        #[Type('list<'.FareSeat\Price::class.'>')]
        public array $prices,

        /** @var list<FareSeat\Vat> */
        #[Type('list<'.FareSeat\Vat::class.'>')]
        public array $vat,

        public int $total,
    ) {}
}
