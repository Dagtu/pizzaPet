<?php

namespace App\Modules\User\Application\Input\RequestsDTO;

use App\Modules\Common\Domain\ValueObjects\IdValue;
use App\Modules\User\Domain\ValueObjects\ApartmentValue;
use App\Modules\User\Domain\ValueObjects\CityValue;
use App\Modules\User\Domain\ValueObjects\HouseNumberValue;
use App\Modules\User\Domain\ValueObjects\RegionValue;
use App\Modules\User\Domain\ValueObjects\StreetValue;

class AddressDTO
{
    public function __construct(
        public readonly RegionValue $region,
        public readonly CityValue $city,
        public readonly StreetValue $street,
        public readonly HouseNumberValue $houseNumber,
        public readonly ApartmentValue $apartment,
        public ?IdValue $id = null,
    ) {}

    public function setAddressId($id): void
    {
        $this->id = new IdValue($id);;
    }

    public function getAddressId() : ?int
    {
        return $this->id?->getValue();
    }

    public function getRegion() : string
    {
        return$this->region->getValue();
    }

    public function getCity() : string
    {
        return $this->city->getValue();
    }

    public function getStreet() : string
    {
        return $this->street->getValue();
    }

    public function getHouseNumber() : int
    {
        return $this->houseNumber->getValue();
    }

    public function getApartment() : int
    {
        return $this->apartment->getValue();
    }
}
