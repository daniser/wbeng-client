<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Functional\do;

use TTBooking\WBEngine\DTO\SearchFlights\Query as SearchFlights;
use TTBooking\WBEngine\DTO\SelectFlight\Query as SelectFlight;
use TTBooking\WBEngine\DTO\CreateBooking\Query as CreateBooking;
use TTBooking\WBEngine\Functional\an;

function fly(): SearchFlights
{
    return an\entity(SearchFlights::class);
}

function choose(): SelectFlight
{
    return an\entity(SelectFlight::class);
}

function book(): CreateBooking
{
    return an\entity(CreateBooking::class);
}
