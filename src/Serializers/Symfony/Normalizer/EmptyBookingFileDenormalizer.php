<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Serializers\Symfony\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use TTBooking\WBEngine\DTO\Common\Result\BookingFile;

final class EmptyBookingFileDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public const EMPTY_BOOKING_FILE_TO_NULL = 'empty_booking_file_to_null';

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if ([] === $data) {
            return null;
        }

        unset($context[self::EMPTY_BOOKING_FILE_TO_NULL]);

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return true === ($context[self::EMPTY_BOOKING_FILE_TO_NULL] ?? false)
            && is_a($type, BookingFile::class, true);
    }

    /**
     * @return array<'*'|'object'|class-string|string, null|bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            BookingFile::class => false,
        ];
    }
}
