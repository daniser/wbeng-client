<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum OfficeReferenceType: string
{
    case Validator = 'validator';
    case TicketPCC = 'ticketPCC';
    case BookPCC = 'bookPCC';
    case SearchPCC = 'searchPCC';
    case OperatorReference = 'operatorReference';
    case CRM = 'CRM';
    case City = 'city';
    case Country = 'country';
}
