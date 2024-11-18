<?php

namespace App\Modules\Order\Domain\Entities;

class OrderEntity
{
    public function __construct(
        public int $id,
        public int $clientId,
        public int $clientAddressId,
        public int $clientPhoneId,
        public string $comment,
        public float $totalPrice,
        public string $status
    ) {}
}
