<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Exception;
use Http\Promise\Promise;
use Psr\Http\Client\ClientExceptionInterface;

interface ClientInterface
{
    /**
     * @param null|StateInterface<ResultInterface> $state
     */
    public function continue(StateInterface $state = null): static;

    /**
     * @template TResult of ResultInterface
     *
     * @param QueryInterface<TResult> $query
     *
     * @return StateInterface<TResult>
     *
     * @throws ClientExceptionInterface
     */
    public function query(QueryInterface $query): StateInterface;

    /**
     * @template TResult of ResultInterface
     *
     * @param QueryInterface<TResult> $query
     *
     * @return Promise<StateInterface<TResult>>
     *
     * @throws Exception
     */
    public function asyncQuery(QueryInterface $query): Promise;
}
