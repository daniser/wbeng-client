<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Request;

use TTBooking\WBEngine\DTO\Enums\RespondType;

class Context
{
    public function __construct(
        public string $login,

        public string $password,

        public string $provider = '',

        public ?string $salePoint = null,

        public string $currency = 'RUB',

        /** @deprecated */
        public string $locale = 'ru',

        /** @deprecated */
        public RespondType $respondType = RespondType::JSON,

        /** @deprecated */
        public int $id = -1,

        /** @deprecated */
        public ?int $context_id = null,
    ) {}
}
