<?php

namespace App\Modules\User\Domain\Entities;

class AddressEntity
{
    public function __construct(
        public int $id,
        public int $clientId,
        public string $region,
        public string $city,
        public string $street,
        public int $houseNumber,
        public int $apartment
    ) {}
}
