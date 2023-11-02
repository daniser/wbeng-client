<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common\Result\BookingFile;
use TTBooking\WBEngine\DTO\Common\Result\Context;
use TTBooking\WBEngine\DTO\Common\Result\Message;
use TTBooking\WBEngine\ResultInterface;

class Result implements ResultInterface
{
    public function __construct(
        public string $token,

        /** @var list<Message> */
        #[Type('list<'.Message::class.'>')]
        public array $messages,

        public Context $context,

        public BookingFile $bookingFile,
    ) {}
}
