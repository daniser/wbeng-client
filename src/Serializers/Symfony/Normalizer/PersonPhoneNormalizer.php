<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Serializers\Symfony\Normalizer;

use libphonenumber\PhoneNumberType;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerAwareTrait;
use TTBooking\WBEngine\DTO\Common\Customer;
use TTBooking\WBEngine\DTO\Common\Passenger;
use TTBooking\WBEngine\DTO\Enums\PhoneType;
use TTBooking\WBEngine\Functional\do;

final class PersonPhoneNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface
{
    use SerializerAwareTrait;

    public const LEGACY = 'legacy';

    public function __construct(private ?string $defaultRegion = null) {}

    /**
     * @return array<'*'|'object'|class-string|string, null|bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            Customer::class => false,
            Passenger::class => false,
        ];
    }

    /**
     * @param array<string, mixed> $context
     *
     * @return array<string, mixed>
     */
    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        $context['decomposed'] = true;

        if (!$this->serializer instanceof NormalizerInterface) {
            throw new LogicException('Cannot decompose phone number because the injected serializer is not a normalizer.');
        }

        /** @var array<string, mixed> $data */
        $data = $this->serializer->normalize($object, $format, $context);

        if (is_array($data) && isset($data['phone']) && is_string($data['phone'])) {
            [$numberType, $countryCode, $areaCode, $subscriberNumber] = do\parse_phone($data['phone'], $this->defaultRegion);
            if ($object instanceof Passenger) {
                $data['phoneType'] = match ($numberType) {
                    PhoneNumberType::MOBILE => PhoneType::Mobile,
                    default => PhoneType::Home,
                };
            }
            $data['countryCode'] = (string) $countryCode;
            $data['areaCode'] = $areaCode;
            $data['phoneNumber'] = $subscriberNumber;
        }

        return $data;
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return true === ($context[self::LEGACY] ?? false)
            && ($data instanceof Customer || $data instanceof Passenger)
            && true !== ($context['decomposed'] ?? false);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (is_array($data) && isset($data['countryCode'], $data['areaCode'], $data['phoneNumber'])) {
            $data['phone'] = sprintf('+%d%s%s', $data['countryCode'], $data['areaCode'], $data['phoneNumber']);
        }

        if (!$this->serializer instanceof DenormalizerInterface) {
            throw new LogicException('Cannot compose phone number because the injected serializer is not a denormalizer.');
        }

        return $this->serializer->denormalize($data, $type, $format, $context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return true === ($context[self::LEGACY] ?? false)
            && (is_a($type, Customer::class, true) || is_a($type, Passenger::class, true))
            && is_array($data) && isset($data['countryCode'], $data['areaCode'], $data['phoneNumber']);
    }
}
