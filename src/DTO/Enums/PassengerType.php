<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\DTO\Enums;

enum PassengerType: string
{
    case Adult = 'ADULT';
    case Child = 'CHILD';
    case Infant = 'INFANT';
    case Youth = 'YOUTH';
    case Senior = 'SENIOR';
    case WSeatInfant = 'WSEATINFANT';
    case Disabled = 'DISABLED';
    case DisabledChild = 'DISABLEDCHILD';
    case Escort = 'ESCORT';
    case LargeFamily = 'LARGEFAMILY';
    case StateResident = 'STATERESIDENT';
    case StateResidentChild = 'STATERESIDENTCHILD';
    case StateResidentYouth = 'STATERESIDENTYOUTH';
    case StateResidentSenior = 'STATERESIDENTSENIOR';
}
