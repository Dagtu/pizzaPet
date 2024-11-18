<?php

namespace App\Modules\Product\Domain\ValueObjects;

use App\Modules\Product\Domain\Enums\ProductTypes;
use InvalidArgumentException;

class TypeValue
{
    private string $type;

    public function __construct(string $type)
    {
        $this->validateValue($type);
        $this->type = $type;
    }

    private function validateValue(string $value): void
    {
        if (!ProductTypes::tryFrom($value)) {
            throw new InvalidArgumentException('Type contains invalid value', 400);
        }
    }

    public function getValue(): string
    {
        return $this->type;
    }
}
