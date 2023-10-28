<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Enums;

use InvalidArgumentException;
use TTBooking\WBEngine\DTO\Common;
use TTBooking\WBEngine\DTO\Common\Request\Context;
use TTBooking\WBEngine\DTO\CreateBooking;
use TTBooking\WBEngine\DTO\FlightFares;
use TTBooking\WBEngine\DTO\SearchFlights;
use TTBooking\WBEngine\DTO\SelectFlight;

enum Query: string
{
    /** Поиск авиаперелетов */
    case Flights = 'flights';

    /** Оценка стоимости авиаперелета */
    case Price = 'price';

    /** Запрос на бронирование */
    case Book = 'book';

    /** Отмена заказа */
    case Cancel = 'cancel';

    /** Запрос на синхронизацию заказа */
    case Display = 'display';

    /** Выписка билета или доп. услуги */
    case Ticket = 'ticket';

    /** Запрос УПТ */
    case Fares = 'fares';

    /** Войдировение заказа и EMD */
    case Void = 'void';

    case Ping = 'ping';

    /** Получение расписания перелетов */
    case Schedule = 'schedule';

    /** Получение дополнительных тарифов */
    case FlightFares = 'flightfares';

    case Matrix = 'matrix';

    case TourCode = 'tourcode';

    case Customer = 'customer';

    /** Сплит брони */
    case Split = 'split';

    /** Получение карты мест */
    case SeatMap = 'seatmap';

    /** Получение списка дополнительных услуг для перелета / бронирования */
    case Ancillaries = 'ancillaries';

    /** Работа с доп. услугами в заказе */
    case Ancillary = 'ancillary';

    case StatusEmd = 'status/emd';

    /** Запрос расчета суммы к возврату */
    case RefundInfo = 'refund/info';

    /** Оформление возврата */
    case RefundExecute = 'refund/execute';

    /** Получение вариантов для обмена */
    case ExchangeInfo = 'exchange/info';

    /** Обмен билетов */
    case ExchangeExecute = 'exchange/execute';

    public function newRequest(Context $context, object $parameters, mixed ...$args): object
    {
        return new ($this->request())($context, $parameters, ...$args);
    }

    /**
     * @return class-string
     */
    public function request(): string
    {
        return match ($this) {
            self::Flights => SearchFlights\Request::class,
            self::Price => Common\Request::class,
            self::Book => CreateBooking\Request::class,
            self::Fares => FlightFares\Request::class,
            default => throw new InvalidArgumentException('Request type not implemented.'),
        };
    }

    /**
     * @return class-string
     */
    public function response(): string
    {
        return match ($this) {
            self::Flights => SearchFlights\Response::class,
            self::Price => SelectFlight\Response::class,
            self::Book => CreateBooking\Response::class,
            self::Fares => FlightFares\Response::class,
            default => throw new InvalidArgumentException('Response type not implemented.'),
        };
    }
}
