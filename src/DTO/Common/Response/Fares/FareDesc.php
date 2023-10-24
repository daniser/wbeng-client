<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response\Fares;

use JMS\Serializer\Annotation\Type;

class FareDesc
{
    public function __construct(
        public FareDesc\Receipt $receipt,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $discounts,

        /** @var list<FareDesc\Rule> */
        #[Type('list<'.FareDesc\Rule::class.'>')]
        public array $rules,
    ) {}
}
