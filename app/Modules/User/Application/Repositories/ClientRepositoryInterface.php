<?php

namespace App\Modules\User\Application\Repositories;

use App\Modules\User\Domain\Entities\AddressEntity;
use App\Modules\User\Domain\Entities\PhoneEntity;

interface ClientRepositoryInterface
{
    public function createAddress(
        int $clientId,
        string $region,
        string $city,
        string $street,
        int $houseNumber,
        int $apartment
    ) : AddressEntity;

    public function createPhone(int $clientId, string $phone) : PhoneEntity;
}
