<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use TTBooking\WBEngine\DTO\Common\Request\Parameters as CommonParams;
use TTBooking\WBEngine\DTO\CreateBooking\Request\Parameters as BookingParams;
use TTBooking\WBEngine\DTO\CreateBooking\Response as BookingResponse;
use TTBooking\WBEngine\DTO\FlightFares\Response as FaresResponse;
use TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters as SearchParams;
use TTBooking\WBEngine\DTO\SearchFlights\Response as SearchResponse;
use TTBooking\WBEngine\DTO\SelectFlight\Response as SelectResponse;

interface ClientInterface
{
    public function searchFlights(SearchParams $parameters): SearchResponse;

    public function selectFlight(CommonParams $parameters): SelectResponse;

    public function createBooking(BookingParams $parameters): BookingResponse;

    public function flightFares(CommonParams $parameters, string $provider, string $gds): FaresResponse;
}
