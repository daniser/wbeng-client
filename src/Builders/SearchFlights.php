<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use DateTimeImmutable;
use DateTimeInterface;
use ReflectionClass;
use TTBooking\WBEngine\DTO\Air\Common\Location;
use TTBooking\WBEngine\DTO\Air\Enums\PassengerType;
use TTBooking\WBEngine\DTO\Air\Enums\ServiceClass;
use TTBooking\WBEngine\DTO\Air\SearchFlights\Request\Parameters;

class SearchFlights extends Parameters
{
    public static function new(): static
    {
        return new static; //(new ReflectionClass(static::class))->newInstanceWithoutConstructor();
    }

    /**
     * @template T ob object
     * @param class-string<T> $class
     * @return T
     */
    protected static function newDTO(string $class): object
    {
        return (new ReflectionClass($class))->newInstanceWithoutConstructor();
    }

    public function from(string $code, string $name = ''): static
    {
        $this->route[0] ??= static::newDTO(Parameters\RouteSegment::class);
        $this->route[0]->locationBegin = new Location($code, $name);

        return $this;
    }

    public function to(string $code, string $name = ''): static
    {
        $this->route[0] ??= static::newDTO(Parameters\RouteSegment::class);
        $this->route[0]->locationEnd = new Location($code, $name);

        return $this;
    }

    public function at(DateTimeInterface|string $date): static
    {
        $this->route[0] ??= static::newDTO(Parameters\RouteSegment::class);
        $this->route[0]->date = is_string($date) ? new DateTimeImmutable($date) : $date;

        return $this;
    }

    public function for(int $count = 1, PassengerType $passengerType = PassengerType::Adult): static
    {
        $this->seats[] = new Parameters\Seat($count, $passengerType);

        return $this;
    }

    public function and(int $count = 1, PassengerType $passengerType = PassengerType::Adult): static
    {
        return $this->for($count, $passengerType);
    }

    public function withServiceClass(ServiceClass $serviceClass): static
    {
        $this->serviceClass = $serviceClass;

        return $this;
    }

    public function skipConnected(bool $skipConnected = true): static
    {
        $this->skipConnected = $skipConnected;

        return $this;
    }

    public function eticketsOnly(bool $eticketsOnly = true): static
    {
        $this->eticketsOnly = $eticketsOnly;

        return $this;
    }

    public function mixedVendors(bool $mixedVendors = true): static
    {
        $this->mixedVendors = $mixedVendors;

        return $this;
    }

    public function preferAirlines(string ...$airlines): static
    {
        $this->preferredAirlines = $airlines;

        return $this;
    }
}
