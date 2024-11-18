<?php

namespace App\Modules\Courier\Infrastructure\Repositories;

use App\Modules\Courier\Application\DataMappers\CourierMapper;
use App\Modules\Courier\Application\Repositories\CourierRepositoryInterface;
use App\Modules\Courier\Infrastructure\Models\Courier;

class CourierRepository implements CourierRepositoryInterface
{
    public function findAvailable($statusPending): array
    {
        return Courier::query()
            ->where('is_active', true)
            ->where('status', $statusPending)
            ->get()
            ->map(fn ($courierModel) => CourierMapper::mapToEntityFromDB(
                id: $courierModel->id,
                name: $courierModel->name,
                lastName: $courierModel->last_name,
                isActive: $courierModel->is_active,
                status: $courierModel->status,
                locationId : $courierModel->location_id
            ))->toArray();
    }

    public function updateCourierStatus(int $id, string $status) : bool
    {
        return Courier::query()->where('id', $id)->update(['status' => $status]) > 0;
    }
}
