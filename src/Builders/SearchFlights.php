<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use DateTimeInterface;
use TTBooking\WBEngine\DTO\Common\Location;
use TTBooking\WBEngine\DTO\Enums\PassengerType;
use TTBooking\WBEngine\DTO\Enums\ServiceClass;
use TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters;
use TTBooking\WBEngine\Functional\{a, is};

class SearchFlights extends Parameters
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

    public function complex(Parameters\RouteSegment ...$segments): static
    {
        $this->route = array_values($segments);

        return $this;
    }

    public function for(Parameters\Seat ...$seats): static
    {
        $cases = array_combine(
            $cc = array_map(static fn (PassengerType $case) => $case->value, PassengerType::cases()),
            array_fill(0, count($cc), 0)
        );

        $map = array_filter(
            array_reduce([...$this->seats, ...$seats], static function (array $accum, Parameters\Seat $seat) {
                $accum[$seat->passengerType->value] += $seat->count;

                return $accum;
            }, $cases)
        );

        $this->seats = array_map(static function (string $type, int $count) {
            return a\seat(passengerType: PassengerType::from($type), count: $count);
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

    public function preferAirlines(string ...$airlines): static
    {
        $this->preferredAirlines = array_values($airlines);

        return $this;
    }
}
