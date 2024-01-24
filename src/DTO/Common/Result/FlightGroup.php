<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\Normalizer\EmptyDateTimeDenormalizer;
use TTBooking\WBEngine\Normalizer\LegacyNormalizer;

class FlightGroup
{
    public string $token;

    /** @deprecated */
    public ?string $aggregator;

    public Common\Carrier $carrier;

    /** @deprecated */
    public ?bool $eticket;

    public bool $latinRegistration;

    #[Context(denormalizationContext: [EmptyDateTimeDenormalizer::EMPTY_DATETIME_TO_NULL => true])]
    public ?DateTimeInterface $timeLimit;

    public string $gds;

    public ?string $terminal;

    public ?bool $allowSSC;

    public bool $allow3D;

    /** @var list<Itinerary> */
    #[Context([LegacyNormalizer::PATH => '[itineraries][itinerary]'])]
    #[Type('list<'.Itinerary::class.'>')]
    public array $itineraries;

    public Fares $fares;

    public string $provider;

    /** @deprecated */
    public ?bool $untouchable;

    public bool $isCharter;

    public bool $isSpecial;

    public bool $isLowcost;

    public bool $isHealthCheckRequired;

    public bool $isTourOperator;

    public bool $allowBookWithAccompany;

    public bool $allowBookWithAncillary;

    public bool $virtualInterlining;

    /** @var list<Common\OfficeReference> */
    #[Type('list<'.Common\OfficeReference::class.'>')]
    public array $officeReference;

    public string $localPriority;
}
