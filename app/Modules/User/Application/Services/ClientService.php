<?php

namespace App\Modules\User\Application\Services;

use App\Modules\User\Application\Input\RequestsDTO\AddressDTO;
use App\Modules\User\Application\Input\RequestsDTO\PhoneDTO;
use App\Modules\User\Application\Repositories\ClientRepositoryInterface;
use App\Modules\User\Domain\Entities\AddressEntity;
use App\Modules\User\Domain\Entities\PhoneEntity;

class ClientService
{
    public function __construct(
        private readonly ClientRepositoryInterface $clientRepository
    ) {}

    public function addAddress(int $clientId, AddressDTO $address) : AddressEntity
    {
        return $this->clientRepository->createAddress(
            $clientId,
            $address->getRegion(),
            $address->getCity(),
            $address->getStreet(),
            $address->getHouseNumber(),
            $address->getApartment()
        );
    }

    public function addPhone(int $clientId, PhoneDTO $phone) : PhoneEntity
    {
        return $this->clientRepository->createPhone($clientId, $phone->getPhone());
    }
}
