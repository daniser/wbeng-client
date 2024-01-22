<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\NameConverter;

use Symfony\Component\Serializer\NameConverter\AdvancedNameConverterInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use TTBooking\WBEngine\StateInterface;

final class LegacyNameConverter implements AdvancedNameConverterInterface
{
    public const LEGACY = StateInterface::ATTR_LEGACY;

    public function __construct(private NameConverterInterface $nameConverter) {}

    /**
     * @param array<string, mixed> $context
     */
    public function normalize(string $propertyName, string $class = null, string $format = null, array $context = []): string
    {
        if (true === ($context[self::LEGACY] ?? false)) {
            return $this->nameConverter instanceof AdvancedNameConverterInterface
                ? $this->nameConverter->normalize($propertyName, $class, $format, $context)
                : $this->nameConverter->normalize($propertyName);
        }

        return $propertyName;
    }

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(string $propertyName, string $class = null, string $format = null, array $context = []): string
    {
        if (true === ($context[self::LEGACY] ?? false)) {
            return $this->nameConverter instanceof AdvancedNameConverterInterface
                ? $this->nameConverter->denormalize($propertyName, $class, $format, $context)
                : $this->nameConverter->denormalize($propertyName);
        }

        return $propertyName;
    }
}
