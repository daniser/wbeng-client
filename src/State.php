<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

/**
 * @template TResult of ResultInterface
 * @template TQuery of QueryInterface<TResult>
 *
 * @implements StateInterface<TResult, TQuery>
 */
class State implements StateInterface
{
    protected string $baseUri;

    /** @var array<string, mixed> */
    protected array $attributes;

    /** @phpstan-var TQuery */
    protected QueryInterface $query;

    /** @phpstan-var TResult */
    protected ResultInterface $result;

    public function setBaseUri(string $baseUri): static
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    public function setAttrs(array $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getAttrs(): array
    {
        return $this->attributes;
    }

    public function setAttr(string $attribute, mixed $value): static
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    public function getAttr(string $attribute, mixed $default = null): mixed
    {
        return $this->attributes[$attribute] ?? $default;
    }

    public function setLegacy(bool $legacy = true): static
    {
        return $this->setAttr(self::ATTR_LEGACY, $legacy);
    }

    public function isLegacy(): bool
    {
        return (bool) $this->getAttr(self::ATTR_LEGACY, true);
    }

    public function setQuery(QueryInterface $query): static
    {
        $this->query = $query;

        return $this;
    }

    public function getQuery(): QueryInterface
    {
        return $this->query;
    }

    public function setResult(ResultInterface $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getResult(): ResultInterface
    {
        return $this->result;
    }
}
