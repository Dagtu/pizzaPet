<?php

namespace App\Modules\User\Domain\ValueObjects;

use InvalidArgumentException;

class HouseNumberValue
{
    private int $value;

    public function __construct(int $number)
    {
        $this->validate($number);
        $this->value = $number;
    }

    private function validate(int $number): void
    {
        if ($number <= 0) {
            throw new InvalidArgumentException('House number must be greater than 0');
        }

        if ($number > 999) {
            throw new InvalidArgumentException('house number must be less than 999');
        }
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
