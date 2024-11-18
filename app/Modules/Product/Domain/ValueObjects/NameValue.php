<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class NameValue
{
    private string $name;

    public function __construct(string $name)
    {
        $this->validateValue($name);
        $this->name = $name;
    }

    private function validateValue(string $value): void
    {
        if (!preg_match("/^[A-zА-я\s]*$/u", $value)) {
            throw new InvalidArgumentException('Name contains invalid characters', 400);
        }
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->name;
    }
}
