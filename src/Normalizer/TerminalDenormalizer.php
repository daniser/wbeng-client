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

    public const STRING_TERMINAL_TO_ARRAY = 'string_terminal_to_array';

    public function denormalize($data, string $type, string $format = null, array $context = []): mixed
    {
        if (false === $data || '' === $data) {
            return null;
        }

        if (is_string($data)) {
            $data = ['code' => $data];
        }

        unset($context[self::STRING_TERMINAL_TO_ARRAY]);

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        return true === ($context[self::STRING_TERMINAL_TO_ARRAY] ?? false)
            && is_a($type, Terminal::class, true);
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Terminal::class => false,
        ];
    }
}
