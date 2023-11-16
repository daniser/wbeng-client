<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use TTBooking\WBEngine\DTO\Common\Terminal;

final class TerminalDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize($data, string $type, string $format = null, array $context = []): mixed
    {
        if (false === $data || '' === $data) {
            return null;
        }

        if (is_string($data)) {
            $data = ['code' => $data];
        }

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        return is_a($type, Terminal::class, true);
    }
}
