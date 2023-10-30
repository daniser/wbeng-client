<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response;

use JMS\Serializer\Annotation\Type;

class Context
{
    public function __construct(
        public string $version,

        public string $environment,

        public string $profile,

        /** @var null|list<string> */
        #[Type('list<string>')]
        public ?array $provider,

        /** @var array<string, string> */
        #[Type('array<string, string>')]
        public array $executionTimeReport,
    ) {}
}
