<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class DescriptionValue
{
    private string $description;

    public function __construct(string $description)
    {
        $this->validateValue($description);
        $this->description = $description;
    }

    private function validateValue(string $value): void
    {
        if (!preg_match('/^[А-яA-z.,!?:"\s]+$/u', $value)) {
            throw new InvalidArgumentException('Description contains invalid characters', 400);
        }
    }

    public function getValue(): string
    {
        return $this->description;
    }
}
