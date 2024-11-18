<?php

namespace App\Modules\Courier\Application\Repositories;

interface CourierRepositoryInterface
{
    public function findAvailable(string $statusPending) : array;

    public function updateCourierStatus(int $id, string $status);
}
