<?php

namespace App\Modules\User\Domain\ValueObjects;

use InvalidArgumentException;

class ApartmentValue
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
            throw new InvalidArgumentException('Apartment number must be a positive number');
        }

        if ($number > 999) {
            throw new InvalidArgumentException('Apartment number cannot be greater than 999');
        }
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
