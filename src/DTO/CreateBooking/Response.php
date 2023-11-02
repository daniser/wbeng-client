<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking;

use JMS\Serializer\Annotation\Type;
use TTBooking\WBEngine\DTO\Common\Response\BookingFile;
use TTBooking\WBEngine\DTO\Common\Response\Context;
use TTBooking\WBEngine\DTO\Common\Response\Message;
use TTBooking\WBEngine\ResultInterface;

class Response implements ResultInterface
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
