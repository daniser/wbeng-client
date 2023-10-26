<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Functional\is;

use TTBooking\WBEngine\Builders\RouteSegmentBuilder;
use TTBooking\WBEngine\Functional\an;

function rollin(): RouteSegmentBuilder
{
    return an\entity(RouteSegmentBuilder::class);
}

namespace TTBooking\WBEngine\Functional\is\rollin;

use DateTimeInterface;
use TTBooking\WBEngine\Builders\RouteSegmentBuilder;
use TTBooking\WBEngine\DTO\Common\Location;
use TTBooking\WBEngine\Functional\is;

function from(Location|string $code, string $name = ''): RouteSegmentBuilder
{
    return is\rollin()->from($code, $name);
}

function to(Location|string $code, string $name = ''): RouteSegmentBuilder
{
    return is\rollin()->to($code, $name);
}

function on(DateTimeInterface|string $date): RouteSegmentBuilder
{
    return is\rollin()->on($date);
}

namespace TTBooking\WBEngine\Functional\a;

use DateTimeImmutable;
use DateTimeInterface;
use TTBooking\WBEngine\DTO\Common\Location;
use TTBooking\WBEngine\DTO\Enums\PassengerType;
use TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters\RouteSegment;
use TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters\Seat;
use TTBooking\WBEngine\Functional\is\rollin;

function location(string $code, string $name = ''): Location
{
    return new Location($code, $name);
}

function date(string $date = 'now'): DateTimeInterface
{
    return new DateTimeImmutable($date);
}

function segment(Location|string $from, Location|string $to, DateTimeInterface|string $on): RouteSegment
{
    return rollin\from($from)->to($to)->on($on);
}

function seat(PassengerType $passengerType, int $count = 1): Seat
{
    return new Seat($passengerType, $count);
}

function child(int $count = 1): Seat
{
    return seat(PassengerType::Child, $count);
}

function senior(int $count = 1): Seat
{
    return seat(PassengerType::Senior, $count);
}

function disabled(int $count = 1): Seat
{
    return seat(PassengerType::Disabled, $count);
}

namespace TTBooking\WBEngine\Functional\an;

use ReflectionClass;
use TTBooking\WBEngine\DTO\Enums\PassengerType;
use TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters\Seat;
use TTBooking\WBEngine\Functional\a;

/**
 * @template T of object
 *
 * @param class-string<T> $class
 *
 * @return T
 */
function entity(string $class): object
{
    $refClass = new ReflectionClass($class);
    $entity = $refClass->newInstanceWithoutConstructor();

    if (!$refParams = $refClass->getConstructor()?->getParameters()) {
        return $entity;
    }

    foreach ($refParams as $refParam) {
        $refParam->isPromoted() && $refParam->isDefaultValueAvailable() && $refClass->hasProperty($refParam->name)
        && $refClass->getProperty($refParam->name)->setValue($entity, $refParam->getDefaultValue());
    }

    return $entity;
}

function adult(int $count = 1): Seat
{
    return a\seat(PassengerType::Adult, $count);
}

function infant(int $count = 1): Seat
{
    return a\seat(PassengerType::Infant, $count);
}

function youth(int $count = 1): Seat
{
    return a\seat(PassengerType::Youth, $count);
}

function escort(int $count = 1): Seat
{
    return a\seat(PassengerType::Escort, $count);
}
