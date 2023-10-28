<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum DocumentType: string
{
    case Internal = 'INTERNAL';
    case Foreign = 'FOREIGN';
    case Passport = 'PASSPORT';
    case BirthCertificate = 'BIRTHDAY_NOTIFICATION';
    case OfficerID = 'OFFICERID';
    case MilitaryID = 'MILITARYID';
    case SeamansID = 'SEAMANSID';
    case ReturnID = 'RETURNID';
}
