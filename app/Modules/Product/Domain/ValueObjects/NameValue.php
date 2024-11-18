<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class NameValue implements ValueObjectInterface
{
    private string $name;

    public function __construct(string $name)
    {
        $this->validateValue($name);
        $this->name = $name;
    }

    /**
     * @param $value
     * @return void
     */
    public function validateValue($value): void
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
