<?php

namespace App\Modules\Common\Domain\ValueObjects;

use InvalidArgumentException;

class IdValue
{
    private int $id;

    public function __construct(int $id)
    {
        $this->validateValue($id);
        $this->id = $id;
    }

    private function validateValue(int $value): void
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('Id cannot be negative or zero', 400);
        }
    }

    public function getValue(): int
    {
        return $this->id;
    }
}
