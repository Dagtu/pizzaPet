<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class IdValue implements ValueObjectInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->validateValue($id);
        $this->id = $id;
    }

    public function validateValue($value): void
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException('Value is not an integer', 400);
        }
    }

    public function getValue(): int
    {
        return $this->id;
    }
}
