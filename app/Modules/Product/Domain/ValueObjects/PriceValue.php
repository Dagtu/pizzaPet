<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class PriceValue
{
    private float $price;

    public function __construct(float $price)
    {
        $this->validateValue($price);
        $this->price = $price;
    }

    private function validateValue(float $value): void
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Price cannot be negative', 400);
        }
    }

    public function getValue(): float
    {
        return $this->price;
    }
}
