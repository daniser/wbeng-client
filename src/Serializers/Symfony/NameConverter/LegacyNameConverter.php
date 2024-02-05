<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Serializers\Symfony\NameConverter;

use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\AdvancedNameConverterInterface;

final class LegacyNameConverter implements AdvancedNameConverterInterface
{
    public const LEGACY = 'legacy';
    public const NAME = 'name';

    /** @var array<string, array<string, null|string>> */
    private static array $normalizeCache = [];

    /** @var array<string, array<string, null|string>> */
    private static array $denormalizeCache = [];

    /** @var array<string, array<string, string>> */
    private static array $attributesMetadataCache = [];

    public function __construct(private readonly ClassMetadataFactoryInterface $metadataFactory) {}

    /**
     * @param array<string, mixed> $context
     */
    public function normalize(string $propertyName, string $class = null, string $format = null, array $context = []): string
    {
        if (!isset($class) || true !== ($context[self::LEGACY] ?? false)) {
            return $propertyName;
        }

        if (!array_key_exists($class, self::$normalizeCache) || !array_key_exists($propertyName, self::$normalizeCache[$class])) {
            self::$normalizeCache[$class][$propertyName] = $this->getCacheValueForNormalization($propertyName, $class);
        }

        return self::$normalizeCache[$class][$propertyName] ?? $propertyName;
    }

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(string $propertyName, string $class = null, string $format = null, array $context = []): string
    {
        if (!isset($class) || true !== ($context[self::LEGACY] ?? false)) {
            return $propertyName;
        }

        $cacheKey = $this->getCacheKey($class, $context);
        if (!array_key_exists($cacheKey, self::$denormalizeCache) || !array_key_exists($propertyName, self::$denormalizeCache[$cacheKey])) {
            self::$denormalizeCache[$cacheKey][$propertyName] = $this->getCacheValueForDenormalization($propertyName, $class, $context);
        }

        return self::$denormalizeCache[$cacheKey][$propertyName] ?? $propertyName;
    }

    private function getCacheValueForNormalization(string $propertyName, string $class): ?string
    {
        if (!$this->metadataFactory->hasMetadataFor($class)) {
            return null;
        }

        $attributesMetadata = $this->metadataFactory->getMetadataFor($class)->getAttributesMetadata();
        if (!array_key_exists($propertyName, $attributesMetadata)) {
            return null;
        }

        $attributeContext = $attributesMetadata[$propertyName]->getNormalizationContextForGroups([]);

        return $attributeContext[self::NAME] ?? null;
    }

    /**
     * @param array<string, mixed> $context
     */
    private function getCacheValueForDenormalization(string $propertyName, string $class, array $context): ?string
    {
        $cacheKey = $this->getCacheKey($class, $context);
        if (!array_key_exists($cacheKey, self::$attributesMetadataCache)) {
            self::$attributesMetadataCache[$cacheKey] = $this->getCacheValueForAttributesMetadata($class, $context);
        }

        return self::$attributesMetadataCache[$cacheKey][$propertyName] ?? null;
    }

    /**
     * @param array<string, mixed> $context
     *
     * @return array<string, string>
     */
    private function getCacheValueForAttributesMetadata(string $class, array $context): array
    {
        if (!$this->metadataFactory->hasMetadataFor($class)) {
            return [];
        }

        $classMetadata = $this->metadataFactory->getMetadataFor($class);

        $cache = [];
        foreach ($classMetadata->getAttributesMetadata() as $name => $metadata) {
            /** @var array{name?: string} $attributeContext */
            $attributeContext = $metadata->getDenormalizationContextForGroups([]);

            if (isset($attributeContext[self::NAME])) {
                $cache[$attributeContext[self::NAME]] = $name;
            }
        }

        return $cache;
    }

    /**
     * @param array<string, mixed> $context
     */
    private function getCacheKey(string $class, array $context): string
    {
        return isset($context['cache_key']) ? $class.'-'.$context['cache_key'] : $class;
    }
}
