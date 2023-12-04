<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use TTBooking\WBEngine\DTO\Common\Result\BookingFile;

final class EmptyBookingFileDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public const EMPTY_BOOKING_FILE_TO_NULL = 'empty_booking_file_to_null';

    public function denormalize($data, string $type, string $format = null, array $context = []): mixed
    {
        if ([] === $data) {
            return null;
        }

        unset($context[self::EMPTY_BOOKING_FILE_TO_NULL]);

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        return true === ($context[self::EMPTY_BOOKING_FILE_TO_NULL] ?? false)
            && is_a($type, BookingFile::class, true);
    }
}
