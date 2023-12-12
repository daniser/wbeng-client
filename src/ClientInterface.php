<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Psr\Http\Client\ClientExceptionInterface;

interface ClientInterface
{
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
}
