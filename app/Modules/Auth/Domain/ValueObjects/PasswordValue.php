<?php

namespace App\Modules\Auth\Domain\ValueObjects;

class PasswordValue implements ValueObjectInterface
{

    private string $password;

    public function __construct(string $value)
    {
        $this->validateValue($value);
        $this->password = $value;
    }

    public function validateValue($value): void
    {
        $minLength = 8;
        $maxLength = 128;
        $pattern = '/^[a-zA-Z0-9\W]+$/';

        if (mb_strlen($value) < $minLength || mb_strlen($value) > $maxLength) {
            throw new \InvalidArgumentException('Password must be between 8 and 128 characters long');
        }

        if (!preg_match($pattern, $value)) {
            throw new \InvalidArgumentException('Password must contain only letters, numbers, and special characters');
        }
    }

    public function getValue(): string
    {
        return $this->password;
    }
}
