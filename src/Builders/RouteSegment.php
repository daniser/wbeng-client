<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use DateTimeInterface;
use TTBooking\WBEngine\DTO\Common\Location;
use TTBooking\WBEngine\Functional\a;

/**
 * @method static static from(Location|string $code, string $name = '')
 * @method static static to(Location|string $code, string $name = '')
 * @method static static on(DateTimeInterface|string $date)
 */
trait RouteSegment
{
    use Buildable;

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
        $this->date = a\date($date);

        return $this;
    }
}
