<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use TTBooking\WBEngine\DTO\Common\Query\Flight;
use TTBooking\WBEngine\DTO\Common\Query\FlightGroup;
use TTBooking\WBEngine\DTO\Common\Query\Itinerary;
use TTBooking\WBEngine\DTO\Common\Result;
use TTBooking\WBEngine\DTO\SelectFlight\Query\Parameters;
use TTBooking\WBEngine\Functional\an;

trait SelectFlight
{
    public function fromSearchResult(Result $response, int $flightGroupId, int $flightId): static
    {
        return $this
            ->fromSearch($response->token)
            ->flightGroup($response->flightGroups[$flightGroupId]->token)
            ->flight($response->flightGroups[$flightGroupId]->itineraries[0]->flights[$flightId]->token);
    }

    public function fromSearch(string $token): static
    {
        $this->parameters ??= an\entity(Parameters::class);
        $this->parameters->token = $token;

        return $this;
    }

    public function flightGroup(string $token): static
    {
        $this->parameters ??= an\entity(Parameters::class);
        $this->parameters->flightGroups[0] ??= an\entity(FlightGroup::class);
        $this->parameters->flightGroups[0]->token = $token;

        return $this;
    }

    public function flight(string $token): static
    {
        $this->parameters ??= an\entity(Parameters::class);
        $this->parameters->flightGroups[0] ??= an\entity(FlightGroup::class);
        $this->parameters->flightGroups[0]->itineraries[0] ??= an\entity(Itinerary::class);
        $this->parameters->flightGroups[0]->itineraries[0]->flights[0] ??= an\entity(Flight::class);
        $this->parameters->flightGroups[0]->itineraries[0]->flights[0]->token = $token;

        return $this;
    }
}
