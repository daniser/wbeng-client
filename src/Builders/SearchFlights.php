<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use DateTimeInterface;
use TTBooking\WBEngine\DTO\Common\Carrier;
use TTBooking\WBEngine\DTO\Common\Location;
use TTBooking\WBEngine\DTO\Common\RouteSegment;
use TTBooking\WBEngine\DTO\Common\Seat;
use TTBooking\WBEngine\DTO\Enums\FlightSorting;
use TTBooking\WBEngine\DTO\Enums\PassengerType;
use TTBooking\WBEngine\DTO\Enums\ServiceClass;
use TTBooking\WBEngine\Functional\{a, is};

trait SearchFlights
{
    public function from(Location|string $code, string $name = ''): static
    {
        $this->route[0] ??= is\rollin();
        $this->route[0]->from($code, $name);

        return $this;
    }

    public function to(Location|string $code, string $name = ''): static
    {
        $this->route[0] ??= is\rollin();
        $this->route[0]->to($code, $name);

        return $this;
    }

    public function on(DateTimeInterface|string $date): static
    {
        $this->route[0] ??= is\rollin();
        $this->route[0]->on($date);

        return $this;
    }

    public function complex(RouteSegment ...$segments): static
    {
        $this->route = array_values($segments);

        return $this;
    }

    public function for(Seat ...$seats): static
    {
        $cases = array_combine(
            $cc = array_map(static fn (PassengerType $case) => $case->value, PassengerType::cases()),
            array_fill(0, count($cc), 0)
        );

        $map = array_filter(
            array_reduce($seats, static function (array $accum, Seat $seat) {
                $accum[$seat->passengerType->value] += $seat->count;

                return $accum;
            }, $cases)
        );

        $this->seats = array_map(static function (string $type, int $count) {
            return a\seat(PassengerType::from($type), $count);
        }, array_keys($map), array_values($map));

        return $this;
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

    public function preferAirlines(Carrier|string ...$airlines): static
    {
        $this->preferredAirlines = array_map(static function (Carrier|string $airline) {
            return is_string($airline) ? a\carrier($airline) : $airline;
        }, array_values($airlines));

        return $this;
    }

    public function ignoreAirlines(Carrier|string ...$airlines): static
    {
        $this->ignoredAirlines = array_map(static function (Carrier|string $airline) {
            return is_string($airline) ? a\carrier($airline) : $airline;
        }, array_values($airlines));

        return $this;
    }

    public function sort(FlightSorting $by): static
    {
        $this->sort = $by;

        return $this;
    }

    public function sortByPrice(): static
    {
        return $this->sort(FlightSorting::Price);
    }

    public function sortByDuration(): static
    {
        return $this->sort(FlightSorting::Duration);
    }

    public function limit(int $to): static
    {
        $this->limit = $to;

        return $this;
    }
}
