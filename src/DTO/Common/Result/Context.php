<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;

class Context
{
    public function __construct(
        public string $version,

        public string $environment,

        public string $profile,

        /** @var null|list<string>|string */
        #[Type('list<string>|string')]
        public null|array|string $provider,

        /** @var array<string, string> */
        #[Type('array<string, string>')]
        public array $executionTimeReport,
    ) {}
}
