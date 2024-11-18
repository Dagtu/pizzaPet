<?php

namespace App\Modules\User\Domain\ValueObjects;

use InvalidArgumentException;

class StreetValue
{
    private string $value;

    public function __construct(string $street)
    {
        $this->validate($street);
        $this->value = $street;
    }

    private function validate(string $street): void
    {
        if (empty($street)) {
            throw new InvalidArgumentException('Street cannot be empty');
        }

        if (strlen($street) > 150) {
            throw new InvalidArgumentException('Street name cannot be longer than 150 characters');
        }

        if (!preg_match('/^[а-яёА-ЯЁA-z\s\-]+$/u', $street)) {
            throw new InvalidArgumentException('Street name contains invalid characters');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
