<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use TTBooking\WBEngine\DTO\Air\FlightFares\Request\Parameters as FaresQuery;
use TTBooking\WBEngine\DTO\Air\FlightFares\Response as FaresResponse;
use TTBooking\WBEngine\DTO\Air\SearchFlights\Request\Parameters as SearchQuery;
use TTBooking\WBEngine\DTO\Air\SearchFlights\Response as SearchResponse;

interface ClientInterface
{
    public function searchFlights(SearchQuery $query): SearchResponse;

    public function flightFares(FaresQuery $query, string $provider, string $gds): FaresResponse;
}
