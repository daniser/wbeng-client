<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Serializers\Symfony\Normalizer;

use BackedEnum;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class CaseInsensitiveBackedEnumDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public const UPPERCASE_BACKED_ENUM = 'uppercase_backed_enum';

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (is_string($data)) {
            $data = strtoupper($data);
        }

        unset($context[self::UPPERCASE_BACKED_ENUM]);

        return $this->denormalizer->denormalize($data, $type, $format, $context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return true === ($context[self::UPPERCASE_BACKED_ENUM] ?? false)
            && is_subclass_of($type, BackedEnum::class);
    }

    /**
     * @return array<'*'|'object'|class-string|string, null|bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            BackedEnum::class => false,
        ];
    }
}
