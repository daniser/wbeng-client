<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response\Segment;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Enums\BaggageType;

class Baggage
{
    public function __construct(
        public ?BaggageType $type,

        public ?string $allow,

        public string $value,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $descriptions,
    ) {}
}
