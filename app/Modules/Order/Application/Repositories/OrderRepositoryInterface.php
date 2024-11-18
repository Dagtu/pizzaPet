<?php

namespace App\Modules\Order\Application\Repositories;

use App\Modules\Order\Domain\Entities\OrderEntity;

interface OrderRepositoryInterface
{
    public function create(
        int $clientId,
        int $clientAddressId,
        int $clientPhoneId,
        string $comment,
        float $totalPrice,
        array $products,
        string $status
    ) : OrderEntity;

    public function updateStatus(int $id, string $status) : bool;
}
