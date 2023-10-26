<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Functional\do;

use TTBooking\WBEngine\Builders\SearchFlights;
use TTBooking\WBEngine\Functional\an;

function fly(): SearchFlights
{
    return an\entity(SearchFlights::class);
}
