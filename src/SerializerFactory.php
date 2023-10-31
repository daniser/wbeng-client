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
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

final class SerializerFactory
{
    public static function createSerializer(): JMSSerializerInterface|SymfonySerializerInterface
    {
        if (interface_exists(SymfonySerializerInterface::class)) {
            return self::createSymfonySerializer();
        }

        if (interface_exists(JMSSerializerInterface::class)) {
            return self::createJMSSerializer();
        }

        throw new Exception('Neither Symfony nor JMS serializer found.');
    }

    public static function createSymfonySerializer(): SymfonySerializerInterface
    {
        $propertyNormalizer = new PropertyNormalizer(
            propertyTypeExtractor: new PropertyInfoExtractor(typeExtractors: [
                new PhpDocExtractor,
                new ReflectionExtractor,
            ]),
            defaultContext: [AbstractObjectNormalizer::SKIP_NULL_VALUES => true],
        );

        return new Serializer(
            [new BackedEnumNormalizer, $propertyNormalizer, new ArrayDenormalizer, new DateTimeNormalizer],
            [new JsonEncoder]
        );
    }

    public static function createJMSSerializer(): JMSSerializerInterface
    {
        return SerializerBuilder::create()
            ->enableEnumSupport()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy)
            ->build();
    }
}
