<?php

namespace App\Modules\Auth\Domain\ValueObjects;

class EmailValue
{
    private string $email;

    public function __construct(string $value)
    {
        $this->validateValue($value);
        $this->email = $value;
    }

    private function validateValue(string $value): void
    {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (!preg_match($pattern, $value)) {
            throw new \InvalidArgumentException('Invalid email format');
        }
    }

    public function getValue(): string
    {
        return $this->email;
    }
}
