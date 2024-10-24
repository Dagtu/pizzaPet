<?php

namespace App\Modules\Auth\Domain\ValueObjects;

class PhoneValue implements ValueObjectInterface
{
    private string $phone;

    public function __construct(string $value)
    {
        $this->validateValue($value);
        $this->phone = $value;
    }

    public function validateValue($value): void
    {
        $pattern = '/^(\+?\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/';

        if (!preg_match($pattern, $value)) {
            throw new \InvalidArgumentException('Invalid phone number');
        }
    }

    public function getValue(): string
    {
        return $this->phone;
    }
}
