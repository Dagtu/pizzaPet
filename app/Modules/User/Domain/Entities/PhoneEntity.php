<?php

namespace App\Modules\User\Domain\Entities;

class PhoneEntity
{
    public function __construct(
        public int $id,
        public int $clientId,
        public string $phone
    ) {}
}
