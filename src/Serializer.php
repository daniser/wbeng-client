<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use JMS\Serializer\SerializerInterface as JMSSerializerInterface;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;
use TTBooking\WBEngine\Serializer\SerializedPath;

class Serializer implements SerializerInterface
{
    public function __construct(protected JMSSerializerInterface|SymfonySerializerInterface $serializer) {}

    public function serialize(mixed $data, array $context = []): string
    {
        static::prepare($context);

        return $this->serializer->serialize($data, 'json');
    }

    public function deserialize(string $data, string $type, array $context = []): object
    {
        static::prepare($context);

        // @phpstan-ignore-next-line
        return $this->serializer->deserialize($data, $type, 'json');
    }

    /**
     * @param array<string, mixed> $context
     */
    protected function prepare(array $context): void
    {
        if ($this->serializer instanceof SymfonySerializerInterface) {
            SerializedPath::setMode(true === ($context['legacy'] ?? false) ? 'legacy' : null);
        }
    }
}
