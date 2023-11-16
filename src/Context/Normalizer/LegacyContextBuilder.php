<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Context\Normalizer;

use Symfony\Component\Serializer\Context\ContextBuilderInterface;
use Symfony\Component\Serializer\Context\ContextBuilderTrait;
use TTBooking\WBEngine\Normalizer\CaseInsensitiveBackedEnumDenormalizer;
use TTBooking\WBEngine\Normalizer\EmptyDateTimeDenormalizer;
use TTBooking\WBEngine\Normalizer\TerminalDenormalizer;

final class LegacyContextBuilder implements ContextBuilderInterface
{
    use ContextBuilderTrait;

    public function withEmptyDateTimeToNull(bool $emptyDateTimeToNull = true): self
    {
        return $this->with(EmptyDateTimeDenormalizer::EMPTY_DATETIME_TO_NULL, $emptyDateTimeToNull);
    }

    public function withUppercaseBackedEnum(bool $uppercaseBackedEnum = true): self
    {
        return $this->with(CaseInsensitiveBackedEnumDenormalizer::UPPERCASE_BACKED_ENUM, $uppercaseBackedEnum);
    }

    public function withStringTerminalToArray(bool $stringTerminalToArray = true): self
    {
        return $this->with(TerminalDenormalizer::STRING_TERMINAL_TO_ARRAY, $stringTerminalToArray);
    }
}
