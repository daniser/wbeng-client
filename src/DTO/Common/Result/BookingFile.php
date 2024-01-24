<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Result;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\Attributes\SerializedPath;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\DTO\Enums\BookingStatus;

class BookingFile
{
    public function __construct(
        public string $token,

        public string $provider,

        public string $gds,

        public string $terminal,

        public string $midoffice,

        /** @var list<Common\OfficeReference> */
        #[Type('list<'.Common\OfficeReference::class.'>')]
        public array $officeReference,

        public string $createDate,

        public BookingStatus $status,

        public string $paymentType,

        /** @var list<Reservation> */
        #[SerializedPath('[reservations]', ['legacy' => '[reservations][reservation]'])]
        #[Type('list<'.Reservation::class.'>')]
        public array $reservations,

        public Common\Customer $customer,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $documents,

        /** @var list<string> */
        #[Type('list<string>')]
        public array $remarks,

        /** @var list<Common\Reference> */
        #[Type('list<'.Common\Reference::class.'>')]
        public array $accompanyingPassengers,

        public Common\TourCode $tourCode,

        public Common\BenefitCode $benefitCode,

        public Common\Code3D $code3D,
    ) {}
}
