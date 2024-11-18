<?php

namespace App\Modules\Common\Domain\ValueObjects;

use InvalidArgumentException;

class PhoneValue
{
    private string $phone;

    public function __construct(string $value)
    {
        $this->validateValue($value);
        $this->phone = $value;
    }

    private function validateValue($value): void
    {
        $pattern = '/^(\+?\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/';

        if (!preg_match($pattern, $value)) {
            throw new InvalidArgumentException('Invalid phone number');
        }
    }

    public function getValue(): string
    {
        return $this->phone;
    }
}
