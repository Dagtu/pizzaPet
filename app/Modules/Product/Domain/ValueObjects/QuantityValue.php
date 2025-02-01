<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class QuantityValue
{
    private int $value;

    public function __construct(int $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    private function validate(int $value): void
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Quantity cannot be negative', 400);
        }

        if ($value > 100) {
            throw new InvalidArgumentException('Quantity cannot be more than 100', 400);
        }
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
