<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use TTBooking\WBEngine\DTO\Common\Request\Parameters as CommonParams;
use TTBooking\WBEngine\DTO\CreateBooking\Request\Parameters as BookingParams;
use TTBooking\WBEngine\DTO\CreateBooking\Response as BookingResponse;
use TTBooking\WBEngine\DTO\FlightFares\Response as FlightFaresResponse;
use TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters as SearchParams;
use TTBooking\WBEngine\DTO\SearchFlights\Response as SearchResponse;
use TTBooking\WBEngine\DTO\SelectFlight\Request\Parameters as SelectParams;
use TTBooking\WBEngine\DTO\SelectFlight\Response as SelectResponse;

interface ClientInterface
{
    public function searchFlights(SearchParams $parameters): SearchResponse;

    public function selectFlight(SelectParams $parameters, string $provider = null, string $gds = null): SelectResponse;

    public function createBooking(BookingParams $parameters, string $provider = null, string $gds = null): BookingResponse;

    public function flightFares(CommonParams $parameters, string $provider = null, string $gds = null): FlightFaresResponse;
}
