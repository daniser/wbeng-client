<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

/**
 * @template TResult of ResultInterface
 */
interface StateInterface
{
    public const ATTR_LEGACY = 'legacy';

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri): static;

    public function getBaseUri(): string;

    /**
     * @param array<string, mixed> $attributes
     *
     * @return $this
     */
    public function setAttrs(array $attributes): static;

    /**
     * @return array<string, mixed>
     */
    public function getAttrs(): array;

    /**
     * @return $this
     */
    public function setAttr(string $attribute, mixed $value): static;

    public function getAttr(string $attribute, mixed $default = null): mixed;

    /**
     * @return $this
     */
    public function setLegacy(): static;

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
