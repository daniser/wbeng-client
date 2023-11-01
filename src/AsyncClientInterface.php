<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Http\Promise\Promise;
use TTBooking\WBEngine\DTO\Common\Request\Parameters as CommonParams;
use TTBooking\WBEngine\DTO\Common\Response;
use TTBooking\WBEngine\DTO\CreateBooking\Request\Parameters as BookingParams;
use TTBooking\WBEngine\DTO\CreateBooking\Response as BookingResponse;
use TTBooking\WBEngine\DTO\FlightFares\Response as FlightFaresResponse;
use TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters as SearchParams;
use TTBooking\WBEngine\DTO\SelectFlight\Request\Parameters as SelectParams;

interface AsyncClientInterface
{
    /**
     * @return Promise<Response>
     */
    public function searchFlightsAsync(SearchParams $parameters): Promise;

    /**
     * @return Promise<Response>
     */
    public function selectFlightAsync(SelectParams $parameters, string $provider = null, string $gds = null): Promise;

    /**
     * @return Promise<BookingResponse>
     */
    public function createBookingAsync(BookingParams $parameters, string $provider = null, string $gds = null): Promise;

    /**
     * @return Promise<FlightFaresResponse>
     */
    public function flightFaresAsync(CommonParams $parameters, string $provider = null, string $gds = null): Promise;
}
