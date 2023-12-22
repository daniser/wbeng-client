<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Normalizer;

use DateTimeInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class EmptyDateTimeDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public const EMPTY_DATETIME_TO_NULL = 'empty_datetime_to_null';

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
    {
        if ('' === $data) {
            return null;
        }

        unset($context[self::EMPTY_DATETIME_TO_NULL]);

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return true === ($context[self::EMPTY_DATETIME_TO_NULL] ?? false)
            && is_a($type, DateTimeInterface::class, true);
    }

    /**
     * @return array<'*'|'object'|class-string|string, null|bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            DateTimeInterface::class => false,
        ];
    }
}
