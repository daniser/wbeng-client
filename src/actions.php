<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Functional\do;

use TTBooking\WBEngine\DTO\SearchFlights\Request\Parameters as SearchFlights;
use TTBooking\WBEngine\DTO\SelectFlight\Request\Parameters as SelectFlight;
use TTBooking\WBEngine\Functional\an;

function fly(): SearchFlights
{
    return an\entity(SearchFlights::class);
}

function choose(): SelectFlight
{
    return an\entity(SelectFlight::class);
}
