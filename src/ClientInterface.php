<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use TTBooking\WBEngine\DTO\Air\Common\Request\Parameters as CommonQuery;
use TTBooking\WBEngine\DTO\Air\CreateBooking\Request\Parameters as BookingQuery;
use TTBooking\WBEngine\DTO\Air\CreateBooking\Response as BookingResponse;
use TTBooking\WBEngine\DTO\Air\FlightFares\Response as FaresResponse;
use TTBooking\WBEngine\DTO\Air\SearchFlights\Request\Parameters as SearchQuery;
use TTBooking\WBEngine\DTO\Air\SearchFlights\Response as SearchResponse;
use TTBooking\WBEngine\DTO\Air\SelectFlight\Response as SelectResponse;

interface ClientInterface
{
    public function searchFlights(SearchQuery $query): SearchResponse;

    public function selectFlight(CommonQuery $query): SelectResponse;

    public function createBooking(BookingQuery $query): BookingResponse;

    public function flightFares(CommonQuery $query, string $provider, string $gds): FaresResponse;
}
