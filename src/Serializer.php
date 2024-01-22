<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use JMS\Serializer\Context;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface as JMSSerializerInterface;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

class Serializer implements SerializerInterface
{
    public function __construct(protected JMSSerializerInterface|SymfonySerializerInterface $serializer) {}

    public function serialize(mixed $data, array $context = []): string
    {
        return $this->serializer->serialize($data, 'json', $this->prepareContext($context));
    }

    public function deserialize(string $data, string $type, array $context = []): object
    {
        // @phpstan-ignore-next-line
        return $this->serializer->deserialize($data, $type, 'json', $this->prepareContext($context, true));
    }

    /**
     * @template TContext of array<string, mixed>
     *
     * @param TContext $context
     *
     * @phpstan-return TContext|($deserialize is true ? DeserializationContext : SerializationContext)|null
     */
    protected function prepareContext(array $context, bool $deserialize = false): null|array|Context
    {
        if ($this->serializer instanceof SymfonySerializerInterface) {
            return $context;
        }

        /** @var null|($deserialize is true ? DeserializationContext : SerializationContext) */
        return $context ? array_reduce(
            array_keys($context),
            static fn (Context $ctx, string $key) => $ctx->setAttribute($key, $context[$key]),
            $deserialize ? DeserializationContext::create() : SerializationContext::create()
        ) : null;
    }
}
