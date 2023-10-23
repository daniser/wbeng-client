<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Enums;

use TTBooking\WBEngine\DTO\Air\Common;
use TTBooking\WBEngine\DTO\Air\Common\Request\Context;
use TTBooking\WBEngine\DTO\Air\CreateBooking;
use TTBooking\WBEngine\DTO\Air\FlightFares;
use TTBooking\WBEngine\DTO\Air\SearchFlights;
use TTBooking\WBEngine\DTO\Air\SelectFlight;

enum Query: string
{
    case Flights = 'flights';
    case Price = 'price';
    case Book = 'book';
    case Fares = 'flightfares';

    public function newRequest(Context $context, object $parameters, mixed ...$args): object
    {
        return new ($this->request())($context, $parameters, ...$args);
    }

    /**
     * @return class-string
     */
    public function request(): string
    {
        return match ($this) {
            self::Flights => SearchFlights\Request::class,
            self::Price => Common\Request::class,
            self::Book => CreateBooking\Request::class,
            self::Fares => FlightFares\Request::class,
        };
    }

    /**
     * @return class-string
     */
    public function response(): string
    {
        return match ($this) {
            self::Flights => SearchFlights\Response::class,
            self::Price => SelectFlight\Response::class,
            self::Book => CreateBooking\Response::class,
            self::Fares => FlightFares\Response::class,
        };
    }
}