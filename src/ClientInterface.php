<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Exception;
use Http\Promise\Promise;

/**
 * @template-covariant TState of StateInterface
 */
interface ClientInterface
{
    /**
     * @template TResult of ResultInterface
     * @template TQuery of QueryInterface<TResult>
     *
     * @phpstan-param null|TState<TResult, TQuery> $state
     *
     * @return self<TState<TResult, TQuery>>
     */
    public function continue(?StateInterface $state = null): self;

    /**
     * @template TResult of ResultInterface
     * @template TQuery of QueryInterface<TResult>
     *
     * @phpstan-param TQuery $query
     *
     * @phpstan-return TState<TResult, TQuery>
     *
     * @throws ClientException
     */
    public function query(QueryInterface $query): StateInterface;

    /**
     * @template TResult of ResultInterface
     * @template TQuery of QueryInterface<TResult>
     *
     * @phpstan-param TQuery $query
     *
     * @return Promise<TState<TResult, TQuery>>
     *
     * @throws Exception
     */
    public function asyncQuery(QueryInterface $query): Promise;
}
