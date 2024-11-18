<?php

namespace App\Modules\Product\Application\Input\RequestsDTO;

use App\Modules\Common\Domain\ValueObjects\IdValue;
use App\Modules\Product\Domain\ValueObjects\PriceValue;
use App\Modules\Product\Domain\ValueObjects\QuantityValue;

class ProductDTO
{
    public function __construct(
        public readonly IdValue $id,
        public readonly PriceValue $price,
        public readonly QuantityValue $quantity
    ) {}

    public function getId(): int
    {
        return $this->id->getValue();
    }

    public function getPrice(): float
    {
        return $this->price->getValue();
    }

    public function getQuantity(): int
    {
        return $this->quantity->getValue();
    }

    public function getTotalPrice(): float|int
    {
        return $this->getPrice() * $this->getQuantity();
    }
}
