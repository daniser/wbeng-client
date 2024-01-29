<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Normalizer;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;

final class LegacyNormalizer implements DenormalizerInterface, NormalizerInterface, SerializerAwareInterface
{
    use SerializerAwareTrait;

    public const PATH = 'path';

    private readonly PropertyAccessorInterface $propertyAccessor;

    public function __construct(PropertyAccessorInterface $propertyAccessor = null)
    {
        $this->propertyAccessor = $propertyAccessor ?? PropertyAccess::createPropertyAccessor();
    }

    /**
     * @return array<'*'|'object'|class-string|string, null|bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return ['*' => false];
    }

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
    {
        /** @var null|string $propertyPath */
        $propertyPath = $context[self::PATH];
        $context['unwrapped'] = true;

        if ($propertyPath && (is_object($data) || is_array($data))) {
            if (!$this->propertyAccessor->isReadable($data, $propertyPath)) {
                return null;
            }

            $data = $this->propertyAccessor->getValue($data, $propertyPath);
        }

        if (!$this->serializer instanceof DenormalizerInterface) {
            throw new LogicException('Cannot unwrap path because the injected serializer is not a denormalizer.');
        }

        return $this->serializer->denormalize($data, $type, $format, $context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return array_key_exists(self::PATH, $context) && !isset($context['unwrapped']);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function normalize(mixed $object, string $format = null, array $context = []): mixed
    {
        /** @var null|string $propertyPath */
        $propertyPath = $context[self::PATH];
        $context['wrapped'] = true;

        if (!$this->serializer instanceof NormalizerInterface) {
            throw new LogicException('Cannot wrap path because the injected serializer is not a normalizer.');
        }

        $data = [];
        $value = $this->serializer->normalize($object, $format, $context);

        if ($propertyPath) {
            if (!$this->propertyAccessor->isWritable($data, $propertyPath)) {
                return null;
            }

            $this->propertyAccessor->setValue($data, $propertyPath, $value);
        }

        return $data;
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return array_key_exists(self::PATH, $context) && !isset($context['wrapped']);
    }
}
