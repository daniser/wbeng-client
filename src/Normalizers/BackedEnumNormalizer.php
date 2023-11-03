<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Normalizers;

use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer as BaseNormalizer;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BackedEnumNormalizer implements NormalizerInterface, DenormalizerInterface, CacheableSupportsMethodInterface
{
    public function __construct(private readonly BaseNormalizer $normalizer = new BaseNormalizer) {}

    public function getSupportedTypes(?string $format): array
    {
        return $this->normalizer->getSupportedTypes($format);
    }

    public function normalize(mixed $object, string $format = null, array $context = []): int|string
    {
        return $this->normalizer->normalize($object, $format, $context);
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $this->normalizer->supportsNormalization($data, $format, $context);
    }

    /**
     * @throws NotNormalizableValueException
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
    {
        $this->normalizer->denormalize(is_string($data) ? strtoupper($data) : $data, $type, $format, $context);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return $this->normalizer->supportsDenormalization($data, $type, $format, $context);
    }

    /**
     * @deprecated since Symfony 6.3, use "getSupportedTypes()" instead
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return $this->normalizer->hasCacheableSupportsMethod();
    }
}
