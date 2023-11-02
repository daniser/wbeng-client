<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Endpoint
{
    public function __construct(public string $endpoint) {}
}
