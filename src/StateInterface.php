<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

/**
 * @template TResult of ResultInterface
 */
interface StateInterface
{
    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri): static;

    public function getBaseUri(): string;

    /**
     * @return $this
     */
    public function setLegacy(bool $legacy = true): static;

    public function isLegacy(): bool;

    /**
     * @param QueryInterface<TResult> $query
     *
     * @return $this
     */
    public function setQuery(QueryInterface $query): static;

    /**
     * @return QueryInterface<TResult>
     */
    public function getQuery(): QueryInterface;

    /**
     * @phpstan-param TResult $result
     *
     * @return $this
     */
    public function setResult(ResultInterface $result): static;

    /**
     * @phpstan-return TResult
     */
    public function getResult(): ResultInterface;
}
