<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;

class Document
{
    public function __construct(
        public string $number,

        #[Type('DateTimeInterface<"Y-m-d">')]
        public DateTimeInterface $issued,

        #[Type('DateTimeInterface<"Y-m-d">')]
        public DateTimeInterface $expired,

        public ?Country $residence = null,
    ) {}
}
