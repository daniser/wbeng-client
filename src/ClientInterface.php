<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use TTBooking\WBEngine\DTO\Air\Common\Request\Parameters as CommonParams;
use TTBooking\WBEngine\DTO\Air\CreateBooking\Request\Parameters as BookingParams;
use TTBooking\WBEngine\DTO\Air\CreateBooking\Response as BookingResponse;
use TTBooking\WBEngine\DTO\Air\FlightFares\Response as FaresResponse;
use TTBooking\WBEngine\DTO\Air\SearchFlights\Request\Parameters as SearchParams;
use TTBooking\WBEngine\DTO\Air\SearchFlights\Response as SearchResponse;
use TTBooking\WBEngine\DTO\Air\SelectFlight\Response as SelectResponse;

interface ClientInterface
{
    public function searchFlights(SearchParams $parameters): SearchResponse;

    public function selectFlight(CommonParams $parameters): SelectResponse;

    public function createBooking(BookingParams $parameters): BookingResponse;

    public function flightFares(CommonParams $parameters, string $provider, string $gds): FaresResponse;
}
