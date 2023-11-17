<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use TTBooking\WBEngine\DTO\Common\Query\Flight;
use TTBooking\WBEngine\DTO\Common\Query\FlightGroup;
use TTBooking\WBEngine\DTO\Common\Query\Itinerary;
use TTBooking\WBEngine\DTO\Common\Result;
use TTBooking\WBEngine\Functional\{a, an};

/**
 * @method static static fromSearchResult(Result $result, int $flightGroupId, int $itineraryId, int $flightId)
 * @method static static fromSearch(string $token)
 * @method static static flightGroup(string $token)
 * @method static static flight(string $token)
 */
trait SelectFlight
{
    use Query;

    public function fromSearchResult(Result $result, int $flightGroupId, int $itineraryId, int $flightId): static
    {
        return $this
            ->fromSearch($result->token)
            ->flightGroup($result->flightGroups[$flightGroupId]->token)
            ->flight($result->flightGroups[$flightGroupId]->itineraries[$itineraryId]->flights[$flightId]->token);
    }

    public function fromSearch(string $token): static
    {
        $this->parameters ??= an\entity(a\property_class(static::class, 'parameters'));
        $this->parameters->token = $token;

        return $this;
    }

    public function flightGroup(string $token): static
    {
        $this->parameters ??= an\entity(a\property_class(static::class, 'parameters'));
        $this->parameters->flightGroups[0] ??= an\entity(FlightGroup::class);
        $this->parameters->flightGroups[0]->token = $token;

        return $this;
    }

    public function flight(string $token): static
    {
        $this->parameters ??= an\entity(a\property_class(static::class, 'parameters'));
        $this->parameters->flightGroups[0] ??= an\entity(FlightGroup::class);
        $this->parameters->flightGroups[0]->itineraries[0] ??= an\entity(Itinerary::class);
        $this->parameters->flightGroups[0]->itineraries[0]->flights[0] ??= an\entity(Flight::class);
        $this->parameters->flightGroups[0]->itineraries[0]->flights[0]->token = $token;

        return $this;
    }
}
