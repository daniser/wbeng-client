<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Attributes;

use Attribute;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\NameConverter\LegacyNameConverter;
use TTBooking\WBEngine\Normalizer\LegacyNormalizer;

#[Attribute(Attribute::TARGET_PROPERTY)]
class SerializedPath extends Context
{
    public function __construct(string $serializedPath)
    {
        $context = [];
        $pathComponents = preg_split('/^\[(.+?)]/', $serializedPath, flags: PREG_SPLIT_DELIM_CAPTURE);

        if (isset($pathComponents[1])) {
            $context[LegacyNameConverter::NAME] = $pathComponents[1];
        }

        if (isset($pathComponents[2])) {
            $context[LegacyNormalizer::PATH] = $pathComponents[2];
        }

        parent::__construct($context);
    }
}
