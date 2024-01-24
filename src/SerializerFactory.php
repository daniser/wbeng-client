<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Exception;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface as JMSSerializerInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Context\Normalizer\PropertyNormalizerContextBuilder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;
use TTBooking\WBEngine\Normalizer\CaseInsensitiveBackedEnumDenormalizer;
use TTBooking\WBEngine\Normalizer\EmptyBookingFileDenormalizer;
use TTBooking\WBEngine\Normalizer\EmptyDateTimeDenormalizer;
use TTBooking\WBEngine\Normalizer\TerminalDenormalizer;
use UnexpectedValueException;

final class SerializerFactory
{
    public static function createSerializer(string $serializer = null): SerializerInterface
    {
        return match ($serializer) {
            'default', null => self::discoverSerializer(),
            'symfony' => self::createSymfonySerializer(),
            'jms' => self::createJMSSerializer(),
            default => throw new UnexpectedValueException("Invalid serializer [$serializer]."),
        };
    }

    public static function discoverSerializer(): SerializerInterface
    {
        if (interface_exists(SymfonySerializerInterface::class)) {
            return self::createSymfonySerializer();
        }

        if (interface_exists(JMSSerializerInterface::class)) {
            return self::createJMSSerializer();
        }

        throw new Exception('Neither Symfony nor JMS serializer found.');
    }

    public static function createSymfonySerializer(): SerializerInterface
    {
        $propertyNormalizer = new PropertyNormalizer(
            $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader),
            new MetadataAwareNameConverter($classMetadataFactory),
            new PropertyInfoExtractor([], [new PhpDocExtractor, new ReflectionExtractor]), null, null,
            (new PropertyNormalizerContextBuilder)
                ->withDisableTypeEnforcement(true)
                ->withSkipNullValues(true)
                ->toArray(),
        );

        return new Serializer(
            new SymfonySerializer(
                [
                    new CaseInsensitiveBackedEnumDenormalizer,
                    new BackedEnumNormalizer,
                    new TerminalDenormalizer,
                    new EmptyBookingFileDenormalizer,
                    $propertyNormalizer,
                    new ArrayDenormalizer,
                    new EmptyDateTimeDenormalizer,
                    new DateTimeNormalizer,
                ],
                [new JsonEncoder]
            )
        );
    }

    public static function createJMSSerializer(): SerializerInterface
    {
        return new Serializer(
            SerializerBuilder::create()
                ->enableEnumSupport()
                ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy)
                ->build()
        );
    }
}
