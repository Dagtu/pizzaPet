<?php

namespace App\Modules\Courier\Application\DataMappers;

use App\Modules\Courier\Domain\Entities\CourierEntity;

class CourierMapper
{
    public static function mapToEntityFromDB(
        int $id,
        string $name,
        string $lastName,
        bool $isActive,
        string $status,
        int $locationId
    ): CourierEntity
    {
        return new CourierEntity(
            id: $id,
            name: $name,
            lastName: $lastName,
            isActive: $isActive,
            status: $status,
            locationId: $locationId
        );
    }
}
