<?php

namespace App\Modules\Payment\Application\Repositories;

use App\Modules\Payment\Domain\Entities\PaymentEntity;

interface PaymentRepositoryInterface
{
    public function create(int $orderId, string $type, string $status) : PaymentEntity;

    public function updateStatus(int $id, string $status) : bool;

    public function updateStatusByOrderId(int $orderId, string $status) : bool;
}
