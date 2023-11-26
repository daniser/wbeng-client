<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Exception;
use Http\Promise\Promise;

interface AsyncClientInterface
{
    /**
     * @template TResult of ResultInterface
     *
     * @param QueryInterface<TResult> $query
     *
     * @return Promise<State<TResult>>
     *
     * @throws Exception
     */
    public function asyncQuery(QueryInterface $query): Promise;
}
