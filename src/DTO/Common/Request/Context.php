<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Request;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Enums\RespondType;

class Context
{
    public function __construct(

        public string $login,

        public string $password,

        /** @var list<int>|null */
        #[Type('list<int>')]
        public ?array $salepoint,

        public string $locale,

        public RespondType $respondType,

        public string $currency,

        public int $id,

        public string $provider,

        public ?int $context_id,

    ) {
    }
}
