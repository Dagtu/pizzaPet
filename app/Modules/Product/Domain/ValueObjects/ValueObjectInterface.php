<?php

namespace App\Modules\Product\Domain\ValueObjects;

interface ValueObjectInterface
{
    public function validateValue($value);

    public function getValue();
}
