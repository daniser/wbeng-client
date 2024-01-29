<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\NameConverter;

use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\AdvancedNameConverterInterface;

final class LegacyNameConverter implements AdvancedNameConverterInterface
{
    public const NAME = 'name';

    public function __construct(private readonly ClassMetadataFactoryInterface $metadataFactory) {}

    /**
     * @param array{name?: string} $context
     */
    public function normalize(string $propertyName, string $class = null, string $format = null, array $context = []): string
    {
        return $context['name'] ?? $propertyName;
    }

    /**
     * @param array{name?: string} $context
     */
    public function denormalize(string $propertyName, string $class = null, string $format = null, array $context = []): string
    {
        if (!isset($class) || !$this->metadataFactory->hasMetadataFor($class)) {
            return $propertyName;
        }

        $attributesMetadata = $this->metadataFactory->getMetadataFor($class)->getAttributesMetadata();

        foreach ($attributesMetadata as $name => $metadata) {
            $contexts = $metadata->getDenormalizationContexts();
        }

        return $propertyName;
    }
}
