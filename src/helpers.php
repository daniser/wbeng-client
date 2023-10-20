<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use TTBooking\WBEngine\Builders\SearchFlights;

function fly(): SearchFlights
{
    return SearchFlights::new();
}
