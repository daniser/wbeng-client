<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response\Fares\FareDesc;

use JMS\Serializer\Annotation\Type;

class Receipt
{
    public function __construct(
        public string $barcode,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $endorsements,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $fareCalculations,

        public ?string $operatorReference,
    ) {}
}
