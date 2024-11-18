<?php

namespace App\Modules\Payment\Domain\Entities;

class PaymentEntity
{
    public function __construct(
        public int $id,
        public int $time,
        public string $status,
        public string $type,
        public int $orderId
    ) {}
}
