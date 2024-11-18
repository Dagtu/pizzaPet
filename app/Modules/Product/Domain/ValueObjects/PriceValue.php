<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class PriceValue implements ValueObjectInterface
{
    private float $price;

    public function __construct(float $price)
    {
        $this->validateValue($price);
        $this->price = $price;
    }

    public function validateValue($value): void
    {
        if (!is_double($value)) {
            throw new InvalidArgumentException('Value is not a double', 400);
        }
    }

    public function getValue(): float
    {
        return $this->price;
    }
}
