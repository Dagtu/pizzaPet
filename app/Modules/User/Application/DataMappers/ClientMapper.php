<?php

namespace App\Modules\User\Application\DataMappers;

use App\Modules\Common\Domain\ValueObjects\IdValue;
use App\Modules\Common\Domain\ValueObjects\PhoneValue;
use App\Modules\User\Application\Input\RequestsDTO\AddressDTO;
use App\Modules\User\Application\Input\RequestsDTO\PhoneDTO;
use App\Modules\User\Domain\Entities\AddressEntity;
use App\Modules\User\Domain\Entities\PhoneEntity;
use App\Modules\User\Domain\ValueObjects\ApartmentValue;
use App\Modules\User\Domain\ValueObjects\CityValue;
use App\Modules\User\Domain\ValueObjects\HouseNumberValue;
use App\Modules\User\Domain\ValueObjects\RegionValue;
use App\Modules\User\Domain\ValueObjects\StreetValue;

class ClientMapper
{
    public static function mapClientAddressToEntityFromDB(
        int $id,
        int $clientId,
        string $region,
        string $city,
        string $street,
        int $houseNumber,
        int $apartment
    ): AddressEntity
    {
        return new AddressEntity($id, $clientId, $region, $city, $street, $houseNumber, $apartment);
    }

    public static function mapClientPhoneToEntityFromDB(int $id, int $clientId, string $phone): PhoneEntity
    {
        return new PhoneEntity($id, $clientId, $phone);
    }

    public function mapToClientAddressDTOFromRequest(
        string $region,
        string $city,
        string $street,
        int $houseNumber,
        int $apartment,
        ?int $id = null,
    ): AddressDTO
    {
        return new AddressDTO(
            new RegionValue($region),
            new CityValue($city),
            new StreetValue($street),
            new HouseNumberValue($houseNumber),
            new ApartmentValue($apartment),
            !empty($id) ? new IdValue($id) : null,
        );
    }

    public function mapToClientPhoneDTOFromRequest(string $phone, ?int $id = null): PhoneDTO
    {
        return new PhoneDTO(new PhoneValue($phone), !empty($id) ? new IdValue($id) : null);
    }
}
