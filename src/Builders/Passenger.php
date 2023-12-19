<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use DateTimeInterface;
use libphonenumber\PhoneNumberType;
use TTBooking\WBEngine\DTO\Common\Carrier;
use TTBooking\WBEngine\DTO\Common\Country;
use TTBooking\WBEngine\DTO\Common\Passport;
use TTBooking\WBEngine\DTO\Enums\DocumentType;
use TTBooking\WBEngine\DTO\Enums\Gender;
use TTBooking\WBEngine\DTO\Enums\PassengerType;
use TTBooking\WBEngine\DTO\Enums\PhoneType;
use TTBooking\WBEngine\Functional\do;
use TTBooking\WBEngine\Functional\{ a, an };

/**
 * @method static static gender(Gender $gender)
 * @method static static sex(Gender $sex)
 * @method static static male()
 * @method static static man()
 * @method static static guy()
 * @method static static lad()
 * @method static static female()
 * @method static static woman()
 * @method static static lady()
 * @method static static lass()
 * @method static static type(PassengerType $type)
 * @method static static age(PassengerType $age)
 * @method static static adult()
 * @method static static child()
 * @method static static infant()
 * @method static static youth()
 * @method static static young()
 * @method static static senior()
 * @method static static elderly()
 * @method static static old()
 * @method static static disabled()
 * @method static static escort()
 * @method static static boy()
 * @method static static girl()
 * @method static static starper()
 * @method static static dedushka()
 * @method static static granny()
 * @method static static babushka()
 * @method static static firstName(string $name)
 * @method static static name(string $name)
 * @method static static lastName(string $lastName)
 * @method static static surname(string $surname)
 * @method static static middleName(string|null $middleName)
 * @method static static patronymic(string|null $patronymic)
 * @method static static birthDate(DateTimeInterface|string $date)
 * @method static static citizenship(Country|string $code, string $name = '')
 * @method static static document(DocumentType $type, string $number, DateTimeInterface|string $issued, DateTimeInterface|string $expired = null)
 * @method static static phone(string $phone, string $defaultRegion = null)
 * @method static static email(string|null $email)
 * @method static static withoutEmail(bool $refused = false)
 * @method static static loyaltyCard(string $id, Carrier|string $carrier)
 */
trait Passenger
{
    use StaticallyCallable;

    public function gender(Gender $gender): static
    {
        $this->passport ??= an\entity(Passport::class);
        $this->passport->gender = $gender;

        return $this;
    }

    public function sex(Gender $sex): static
    {
        return $this->gender($sex);
    }

    public function male(): static
    {
        return $this->gender(Gender::Male);
    }

    public function man(): static
    {
        return $this->male();
    }

    public function guy(): static
    {
        return $this->male();
    }

    public function lad(): static
    {
        return $this->male();
    }

    public function female(): static
    {
        return $this->gender(Gender::Female);
    }

    public function woman(): static
    {
        return $this->female();
    }

    public function lady(): static
    {
        return $this->female();
    }

    public function lass(): static
    {
        return $this->female();
    }

    public function type(PassengerType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function age(PassengerType $age): static
    {
        return $this->type($age);
    }

    public function adult(): static
    {
        return $this->type(PassengerType::Adult);
    }

    public function child(): static
    {
        return $this->type(PassengerType::Child);
    }

    public function infant(): static
    {
        return $this->type(PassengerType::Infant);
    }

    public function youth(): static
    {
        return $this->type(PassengerType::Youth);
    }

    public function young(): static
    {
        return $this->youth();
    }

    public function senior(): static
    {
        return $this->type(PassengerType::Senior);
    }

    public function elderly(): static
    {
        return $this->senior();
    }

    public function old(): static
    {
        return $this->senior();
    }

    public function disabled(): static
    {
        return $this->type(PassengerType::Disabled);
    }

    public function escort(): static
    {
        return $this->type(PassengerType::Escort);
    }

    public function boy(): static
    {
        return $this->child()->male();
    }

    public function girl(): static
    {
        return $this->child()->female();
    }

    public function starper(): static
    {
        return $this->senior()->male();
    }

    public function dedushka(): static
    {
        return $this->senior()->male();
    }

    public function granny(): static
    {
        return $this->senior()->female();
    }

    public function babushka(): static
    {
        return $this->senior()->female();
    }

    public function firstName(string $name): static
    {
        $this->passport ??= an\entity(Passport::class);
        $this->passport->firstName = $name;

        return $this;
    }

    public function name(string $name): static
    {
        return $this->firstName($name);
    }

    public function lastName(string $lastName): static
    {
        $this->passport ??= an\entity(Passport::class);
        $this->passport->lastName = $lastName;

        return $this;
    }

    public function surname(string $surname): static
    {
        return $this->lastName($surname);
    }

    public function middleName(?string $middleName): static
    {
        $this->passport ??= an\entity(Passport::class);
        $this->passport->middleName = $middleName;

        return $this;
    }

    public function patronymic(?string $patronymic): static
    {
        return $this->middleName($patronymic);
    }

    public function birthDate(DateTimeInterface|string $date): static
    {
        $this->passport ??= an\entity(Passport::class);
        $this->passport->birthday = a\date($date);

        return $this;
    }

    public function citizenship(Country|string $code, string $name = ''): static
    {
        $this->passport ??= an\entity(Passport::class);
        $this->passport->citizenship = is_string($code) ? a\country($code, $name) : $code;

        return $this;
    }

    public function document(DocumentType $type, string $number, DateTimeInterface|string $issued, DateTimeInterface|string $expired = null): static
    {
        $this->passport ??= an\entity(Passport::class);
        $this->passport->type = $type;
        $this->passport->number = $number;
        $this->passport->issued = a\date($issued);
        $this->passport->expired = a\date($expired ?? '+10 years');

        return $this;
    }

    public function phone(string $phone, string $defaultRegion = null): static
    {
        [$numberType, $countryCode, $areaCode, $subscriberNumber] = do\parse_phone($phone, $defaultRegion);

        $this->phoneType = match ($numberType) {
            PhoneNumberType::MOBILE => PhoneType::Mobile,
            default => PhoneType::Home,
        };

        $this->countryCode = (string) $countryCode;
        $this->areaCode = $areaCode;
        $this->phoneNumber = $subscriberNumber;

        return $this;
    }

    public function email(?string $email): static
    {
        $this->email = $email;
        $this->isEmailAbsent = is_null($email);

        return $this;
    }

    public function withoutEmail(bool $refused = false): static
    {
        $this->email = null;
        $this->isEmailRefused = $refused;
        $this->isEmailAbsent = !$refused;

        return $this;
    }

    public function loyaltyCard(string $id, Carrier|string $carrier): static
    {
        $this->loyaltyCard = a\loyalty_card($id, $carrier);

        return $this;
    }
}
