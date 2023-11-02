<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Functional\do;

use TTBooking\WBEngine\DTO\SearchFlights\Request as SearchFlights;
use TTBooking\WBEngine\DTO\SelectFlight\Request as SelectFlight;
use TTBooking\WBEngine\Functional\an;

function fly(): SearchFlights
{
    return an\entity(SearchFlights::class);
}

function choose(): SelectFlight
{
    return an\entity(SelectFlight::class);
}
