<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

interface SerializerInterface
{
    public function serialize(mixed $data): string;

    /**
     * @template T of object
     *
     * @param class-string<T> $type
     *
     * @phpstan-return T
     */
    public function deserialize(string $data, string $type): object;
}
