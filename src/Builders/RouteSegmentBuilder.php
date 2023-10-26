<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use DateTimeInterface;
use TTBooking\WBEngine\DTO\Common\Location;
use TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters\RouteSegment;
use TTBooking\WBEngine\Functional\a;

class RouteSegmentBuilder extends RouteSegment
{
    public function from(Location|string $code, string $name = ''): static
    {
        $this->locationBegin = is_string($code) ? a\location($code, $name) : $code;

        return $this;
    }

    public function to(Location|string $code, string $name = ''): static
    {
        $this->locationEnd = is_string($code) ? a\location($code, $name) : $code;

        return $this;
    }

    public function on(DateTimeInterface|string $date): static
    {
        $this->date = is_string($date) ? a\date($date) : $date;

        return $this;
    }
}
