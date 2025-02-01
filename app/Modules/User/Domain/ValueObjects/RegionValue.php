<?php

namespace App\Modules\User\Domain\ValueObjects;

use InvalidArgumentException;

class RegionValue
{
    private string $value;

    public function __construct(string $region)
    {
        $this->validate($region);
        $this->value = $region;
    }

    private function validate(string $region): void
    {
        if (empty($region)) {
            throw new InvalidArgumentException('Region cannot be empty');
        }

        if (strlen($region) > 100) {
            throw new InvalidArgumentException('Region name cannot be longer than 100 characters');
        }

        if (!preg_match('/^[а-яёА-ЯЁA-z\s\-]+$/u', $region)) {
            throw new InvalidArgumentException('Region name must contain only letters, hyphens, and spaces');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
