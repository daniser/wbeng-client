<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Functional\do;

use libphonenumber\PhoneNumberUtil;
use TTBooking\WBEngine\DTO\CreateBooking\Query as CreateBooking;
use TTBooking\WBEngine\DTO\SearchFlights\Query as SearchFlights;
use TTBooking\WBEngine\DTO\SelectFlight\Query as SelectFlight;
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

/**
 * @return array{int, null|int, string, string}
 */
function parse_phone(string $phone): array
{
    $phoneUtil = PhoneNumberUtil::getInstance();
    $phoneNumber = $phoneUtil->parse($phone);
    $nationalSignificantNumber = $phoneUtil->getNationalSignificantNumber($phoneNumber);
    $areaCodeLength = $phoneUtil->getLengthOfGeographicalAreaCode($phoneNumber);

    return [
        $phoneUtil->getNumberType($phoneNumber),
        $phoneNumber->getCountryCode(),
        $areaCodeLength > 0 ? substr($nationalSignificantNumber, 0, $areaCodeLength) : '',
        $areaCodeLength > 0 ? substr($nationalSignificantNumber, $areaCodeLength) : $nationalSignificantNumber,
    ];
}
