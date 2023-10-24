<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Common\Response;

use DateTimeInterface;
use JMS\Serializer\Annotation\Type;

class Ancillary
{
    public function __construct(
        public string $token,

        public string $serviceCode,

        public string $serviceGroup,

        public ServiceName $serviceName,

        #[Type('DateTimeInterface<"Y-m-d\TH:i:s">')]
        public DateTimeInterface $confirmationDate,

        public int $total,
    ) {}
}
