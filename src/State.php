<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

/**
 * @template TResult of ResultInterface
 *
 * @implements StateInterface<TResult>
 */
class State implements StateInterface
{
    protected string $baseUri;

    protected bool $legacy = false;

    /** @var QueryInterface<TResult> */
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

    public function setLegacy(bool $legacy = true): static
    {
        $this->legacy = $legacy;

        return $this;
    }

    public function isLegacy(): bool
    {
        return $this->legacy;
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
