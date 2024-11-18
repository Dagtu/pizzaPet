<?php

namespace App\Modules\Common\Domain\ValueObjects;

use InvalidArgumentException;

class IsActiveValue
{
    private bool $isActive;

    public function __construct(bool $isActive)
    {
        $this->isActive = $isActive;
    }

    public function getValue(): bool
    {
        return $this->isActive;
    }
}
