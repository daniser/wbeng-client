<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use TTBooking\WBEngine\DTO\Common\Customer;
use TTBooking\WBEngine\Functional\an;

/**
 * @method static static customer(string $name, string $email, string $countryCode, string $areaCode, string $phoneNumber)
 */
trait CreateBooking
{
    use SelectFlight;

    public function customer(string $name, string $email, string $countryCode, string $areaCode, string $phoneNumber): static
    {
        $this->parameters ??= an\entity($this->parameters::class);
        $this->parameters->customer = new Customer($name, $email, $countryCode, $areaCode, $phoneNumber);

        return $this;
    }
}
