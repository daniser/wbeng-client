<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Context;
use TTBooking\WBEngine\Attributes\SerializedPath;
use TTBooking\WBEngine\DTO\Common\Result\BookingFile;
use TTBooking\WBEngine\DTO\Common\Result\Context as ResultContext;
use TTBooking\WBEngine\DTO\Common\Result\Message;
use TTBooking\WBEngine\Normalizer\EmptyBookingFileDenormalizer;
use TTBooking\WBEngine\ResultInterface;

class Result implements ResultInterface
{
    public function __construct(
        public ?string $token,

        /** @var list<Message> */
        #[SerializedPath('[messages]', ['legacy' => '[messages][message]'])]
        #[Type('list<'.Message::class.'>')]
        public array $messages,

        public ?ResultContext $context,

        #[Context(denormalizationContext: [EmptyBookingFileDenormalizer::EMPTY_BOOKING_FILE_TO_NULL => true])]
        public ?BookingFile $bookingFile,
    ) {}
}
