<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class IsActiveValue implements ValueObjectInterface
{
    private bool $isActive;

    public function __construct(bool $isActive)
    {
        $this->validateValue($isActive);
        $this->isActive = $isActive;
    }

    /**
     * @param $value
     * @return void
     */
    public function validateValue($value): void
    {
        if (!is_bool($value)) {
            throw new InvalidArgumentException('Value is not a boolean', 400);
        }
    }

    /**
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->isActive;
    }
}
