<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use TTBooking\WBEngine\DTO\Common\Carrier;
use TTBooking\WBEngine\DTO\Common\Code3D;
use TTBooking\WBEngine\DTO\Common\Customer;
use TTBooking\WBEngine\Functional\{a, an};
use TTBooking\WBEngine\DTO\Common\Passenger;

/**
 * @method static static customer(string $name, string $email, string $countryCode, string $areaCode, string $phoneNumber)
 * @method static static passengers(Passenger ...$passengers)
 * @method static static tourCode(string $code, Carrier|string $carrier)
 * @method static static benefitCode(string $code, Carrier|string $carrier)
 * @method static static code3D(string $code)
 */
trait CreateBooking
{
    use SelectFlight;

    public function customer(string $name, string $email, string $countryCode, string $areaCode, string $phoneNumber): static
    {
        $this->parameters ??= an\entity(a\property_class(static::class, 'parameters'));
        $this->parameters->customer = new Customer($name, $email, $countryCode, $areaCode, $phoneNumber);

        return $this;
    }

    public function passengers(Passenger ...$passengers): static
    {
        $this->parameters ??= an\entity(a\property_class(static::class, 'parameters'));
        $this->parameters->passengers = array_values($passengers);

        return $this;
    }

    public function tourCode(string $code, Carrier|string $carrier): static
    {
        $this->parameters ??= an\entity(a\property_class(static::class, 'parameters'));
        $this->parameters->tourCode = a\tour_code($code, $carrier);

        return $this;
    }

    public function benefitCode(string $code, Carrier|string $carrier): static
    {
        $this->parameters ??= an\entity(a\property_class(static::class, 'parameters'));
        $this->parameters->benefitCode = a\benefit_code($code, $carrier);

        return $this;
    }

    public function code3D(string $code): static
    {
        $this->parameters ??= an\entity(a\property_class(static::class, 'parameters'));
        $this->parameters->code3D = new Code3D($code);

        return $this;
    }
}
