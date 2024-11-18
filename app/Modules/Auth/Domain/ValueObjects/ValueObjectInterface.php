<?php

namespace App\Modules\Auth\Domain\ValueObjects;

interface ValueObjectInterface
{
    public function validateValue($value);

    public function getValue();
}
