<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use TTBooking\WBEngine\DTO\Common\Request\Flight;
use TTBooking\WBEngine\DTO\Common\Request\FlightGroup;
use TTBooking\WBEngine\DTO\Common\Request\Itinerary;
use TTBooking\WBEngine\DTO\SearchFlights\Response;
use TTBooking\WBEngine\Functional\an;

trait SelectFlight
{
    public function fromSearchResponse(Response $response, int $flightGroupId, int $flightId): static
    {
        return $this
            ->fromSearch($response->token)
            ->flightGroup($response->flightGroups[$flightGroupId]->token)
            ->flight($response->flightGroups[$flightGroupId]->itineraries[0]->flights[$flightId]->token);
    }

    public function fromSearch(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function flightGroup(string $token): static
    {
        $this->flightsGroup[0] ??= an\entity(FlightGroup::class);
        $this->flightsGroup[0]->token = $token;

        return $this;
    }

    public function flight(string $token): static
    {
        $this->flightsGroup[0] ??= an\entity(FlightGroup::class);
        $this->flightsGroup[0]->itineraries[0] ??= an\entity(Itinerary::class);
        $this->flightsGroup[0]->itineraries[0]->flights[0] ??= an\entity(Flight::class);
        $this->flightsGroup[0]->itineraries[0]->flights[0]->token = $token;

        return $this;
    }
}
