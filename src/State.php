<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

/**
 * @template TResult of ResultInterface
 */
class State
{
    public string $baseUri;

    public bool $legacy = false;

    /** @var QueryInterface<TResult> */
    public QueryInterface $query;

    /** @phpstan-var TResult */
    public ResultInterface $result;

    /**
     * @return $this
     */
    public function baseUri(string $baseUri): static
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * @return $this
     */
    public function legacy(bool $legacy = true): static
    {
        $this->legacy = $legacy;

        return $this;
    }

    /**
     * @param QueryInterface<TResult> $query
     *
     * @return $this
     */
    public function query(QueryInterface $query): static
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @phpstan-param TResult $result
     *
     * @return $this
     */
    public function result(ResultInterface $result): static
    {
        $this->result = $result;

        return $this;
    }
}
