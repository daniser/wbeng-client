<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response\Fares\FareDesc;

use JMS\Serializer\Annotation\Type;

class Rule
{
    public function __construct(
        public string $type,

        public bool $allowed,

        public string $applicability,

        public ?string $penalty,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $descriptions,
    ) {}
}
