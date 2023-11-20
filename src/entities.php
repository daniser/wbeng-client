<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Functional\is;

use TTBooking\WBEngine\DTO\Common\RouteSegment;
use TTBooking\WBEngine\Functional\an;

function rollin(): RouteSegment
{
    return an\entity(RouteSegment::class);
}

namespace TTBooking\WBEngine\Functional\is\rollin;

use DateTimeInterface;
use TTBooking\WBEngine\DTO\Common\Location;
use TTBooking\WBEngine\DTO\Common\RouteSegment;
use TTBooking\WBEngine\Functional\is;

function from(Location|string $code, string $name = ''): RouteSegment
{
    return is\rollin()->from($code, $name);
}

function to(Location|string $code, string $name = ''): RouteSegment
{
    return is\rollin()->to($code, $name);
}

function on(DateTimeInterface|string $date): RouteSegment
{
    return is\rollin()->on($date);
}

namespace TTBooking\WBEngine\Functional\a;

use DateTimeImmutable;
use DateTimeInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use TTBooking\WBEngine\DTO\Common\BenefitCode;
use TTBooking\WBEngine\DTO\Common\Carrier;
use TTBooking\WBEngine\DTO\Common\Country;
use TTBooking\WBEngine\DTO\Common\Location;
use TTBooking\WBEngine\DTO\Common\LoyaltyCard;
use TTBooking\WBEngine\DTO\Common\Passenger;
use TTBooking\WBEngine\DTO\Common\RouteSegment;
use TTBooking\WBEngine\DTO\Common\Seat;
use TTBooking\WBEngine\DTO\Common\TourCode;
use TTBooking\WBEngine\DTO\Enums\PassengerType;
use TTBooking\WBEngine\Functional\{ an, is\rollin };

/**
 * @param class-string|object $objectOrClass
 *
 * @return class-string
 *
 * @throws ReflectionException
 */
function property_class(object|string $objectOrClass, string $propertyName): string
{
    $refClass = new ReflectionClass($objectOrClass);
    $refType = $refClass->getProperty($propertyName)->getType();

    if ($refType instanceof ReflectionNamedType) {
        /** @var class-string */
        return $refType->getName();
    }

    throw new ReflectionException("Property \"$propertyName\" has no type or has more than one type.");
}

function location(string $code, string $name = ''): Location
{
    return new Location($code, $name);
}

function country(string $code, string $name = ''): Country
{
    return new Country($code, $name);
}

function carrier(string $code, string $name = ''): Carrier
{
    return new Carrier($code, $name);
}

function tour_code(string $code, Carrier|string $carrier): TourCode
{
    return new TourCode($code, is_string($carrier) ? carrier($carrier) : $carrier);
}

function benefit_code(string $code, Carrier|string $carrier): BenefitCode
{
    return new BenefitCode($code, is_string($carrier) ? carrier($carrier) : $carrier);
}

function loyalty_card(string $id, Carrier|string $carrier): LoyaltyCard
{
    return new LoyaltyCard($id, is_string($carrier) ? carrier($carrier) : $carrier);
}

function date(DateTimeInterface|string $date = 'now'): DateTimeInterface
{
    return is_string($date) ? new DateTimeImmutable($date) : $date;
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

function passenger(): Passenger
{
    return an\entity(Passenger::class);
}

namespace TTBooking\WBEngine\Functional\an;

use ReflectionClass;
use TTBooking\WBEngine\DTO\Common\Seat;
use TTBooking\WBEngine\DTO\Enums\PassengerType;
use TTBooking\WBEngine\Functional\a;

/**
 * @template T of object
 *
 * @param class-string<T> $class
 *
 * @phpstan-return T
 */
function entity(string $class): object
{
    $refClass = new ReflectionClass($class);
    $refParams = $refClass->getConstructor()?->getParameters() ?? [];
    $entity = $refClass->newInstanceWithoutConstructor();

    foreach ($refParams as $refParam) {
        $refParam->isPromoted() && $refParam->isDefaultValueAvailable() && $refClass->hasProperty($refParam->name)
        && $refClass->getProperty($refParam->name)->setValue($entity, $refParam->getDefaultValue());
    }

    /** @var T */
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
