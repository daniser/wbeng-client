<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Doctrine\Common\Annotations\AnnotationReader;
use Exception;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface as JMSSerializerInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;
use UnexpectedValueException;

final class SerializerFactory
{
    public static function createSerializer(string $serializer = null, bool $legacy = false): JMSSerializerInterface|SymfonySerializerInterface
    {
        return match ($serializer) {
            'default', null => self::discoverSerializer($legacy),
            'symfony' => self::createSymfonySerializer($legacy),
            'jms' => self::createJMSSerializer($legacy),
            default => throw new UnexpectedValueException("Invalid serializer [$serializer]."),
        };
    }

    public static function discoverSerializer(bool $legacy = false): JMSSerializerInterface|SymfonySerializerInterface
    {
        if (interface_exists(SymfonySerializerInterface::class)) {
            return self::createSymfonySerializer($legacy);
        }

        if (interface_exists(JMSSerializerInterface::class)) {
            return self::createJMSSerializer($legacy);
        }

        throw new Exception('Neither Symfony nor JMS serializer found.');
    }

    public static function createSymfonySerializer(bool $legacy = false): SymfonySerializerInterface
    {
        $propertyNormalizer = new PropertyNormalizer(
            $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader)),
            $legacy ? new MetadataAwareNameConverter($classMetadataFactory) : null,
            new PropertyInfoExtractor([], [new PhpDocExtractor, new ReflectionExtractor]),
            null, null,
            [AbstractObjectNormalizer::SKIP_NULL_VALUES => true],
        );

        return new Serializer(
            [new BackedEnumNormalizer, $propertyNormalizer, new ArrayDenormalizer, new DateTimeNormalizer],
            [new JsonEncoder]
        );
    }

    public static function createJMSSerializer(bool $legacy = false): JMSSerializerInterface
    {
        return SerializerBuilder::create()
            ->enableEnumSupport()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy)
            ->build();
    }
}
