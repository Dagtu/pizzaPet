<?php

namespace App\Modules\User\Domain\ValueObjects;

use InvalidArgumentException;

class CityValue
{
    private string $value;

    public function __construct(string $city)
    {
        $this->validate($city);
        $this->value = $city;
    }

    private function validate(string $city): void
    {
        if (empty($city)) {
            throw new InvalidArgumentException('City name cannot be empty');
        }

        if (strlen($city) > 100) {
            throw new InvalidArgumentException('City name cannot be longer than 100 characters');
        }

        if (!preg_match('/^[а-яёА-ЯЁA-z\s\-]+$/u', $city)) {
            throw new InvalidArgumentException('City name can only contain letters, spaces, hyphens, and dashes');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
