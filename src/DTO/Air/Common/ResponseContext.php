<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Air\Common;

use JMS\Serializer\Annotation\Type;

class ResponseContext
{
    public function __construct(

        public string $version,

        public string $environment,

        public string $profile,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $provider,

        /** @var array<string, string> */
        #[Type('array<string, string>')]
        public array $executionTimeReport,

    ) {
    }
}
