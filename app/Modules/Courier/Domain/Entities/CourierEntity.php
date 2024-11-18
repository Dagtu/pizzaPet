<?php

namespace App\Modules\Courier\Domain\Entities;

class CourierEntity
{
    public function __construct(
        public int $id,
        public string $name,
        public string $lastName,
        public bool $isActive,
        public string $status,
        public int $locationId
    ) {}
}
