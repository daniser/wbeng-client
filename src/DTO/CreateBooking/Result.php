<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\CreateBooking;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Attribute\Context;
use TTBooking\WBEngine\DTO\Common\Result\BookingFile;
use TTBooking\WBEngine\DTO\Common\Result\Context as ResultContext;
use TTBooking\WBEngine\DTO\Common\Result\Message;
use TTBooking\WBEngine\ResultInterface;
use TTBooking\WBEngine\Serializers\Symfony\Attribute\SerializedPath;
use TTBooking\WBEngine\Serializers\Symfony\Normalizer\EmptyBookingFileDenormalizer;

class Result implements ResultInterface
{
    public function __construct(
        public ?string $token,

        /** @var list<Message> */
        #[SerializedPath('[messages][message]')]
        #[Type('list<'.Message::class.'>')]
        public array $messages,

        public ?ResultContext $context,

        #[Context(denormalizationContext: [EmptyBookingFileDenormalizer::EMPTY_BOOKING_FILE_TO_NULL => true])]
        public ?BookingFile $bookingFile,
    ) {}
}
