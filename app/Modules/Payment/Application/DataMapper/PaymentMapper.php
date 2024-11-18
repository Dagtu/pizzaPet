<?php

namespace App\Modules\Payment\Application\DataMapper;

use App\Modules\Payment\Domain\Entities\PaymentEntity;

class PaymentMapper
{
    public static function mapToEntityFromDB(int $id, int $time, string $status, string $type, int $orderId): PaymentEntity
    {
        return new PaymentEntity($id, $time, $status, $type, $orderId);
    }
}
