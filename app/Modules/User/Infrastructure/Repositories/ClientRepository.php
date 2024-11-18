<?php

namespace App\Modules\User\Infrastructure\Repositories;

use App\Modules\User\Application\DataMappers\ClientMapper;
use App\Modules\User\Application\Repositories\ClientRepositoryInterface;
use App\Modules\User\Domain\Entities\AddressEntity;
use App\Modules\User\Domain\Entities\PhoneEntity;
use App\Modules\User\Infrastructure\Models\ClientAddress;
use App\Modules\User\Infrastructure\Models\ClientPhone;

class ClientRepository implements ClientRepositoryInterface
{
    public function createAddress(
        int $clientId,
        string $region,
        string $city,
        string $street,
        int $houseNumber,
        int $apartment
    ): AddressEntity
    {
        $clientAddress = ClientAddress::query()->create([
            'client_id' => $clientId,
            'region' => $region,
            'city' => $city,
            'street' => $street,
            'house_number' => $houseNumber,
            'apartment' => $apartment
        ]);

        return ClientMapper::mapClientAddressToEntityFromDB(
            $clientAddress->id,
            $clientAddress->client_id,
            $clientAddress->region,
            $clientAddress->city,
            $clientAddress->street,
            $clientAddress->house_number,
            $clientAddress->apartment
        );
    }

    public function createPhone(int $clientId, string $phone): PhoneEntity
    {
        $clientPhone = ClientPhone::query()->create([
            'client_id' => $clientId,
            'phone' => $phone
        ]);

        return ClientMapper::mapClientPhoneToEntityFromDB(
            $clientPhone->id,
            $clientPhone->client_id,
            $clientPhone->phone
        );
    }
}
