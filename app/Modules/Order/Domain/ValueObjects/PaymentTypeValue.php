<?php

namespace App\Modules\Order\Domain\ValueObjects;

use App\Modules\Payment\Domain\Enums\PaymentTypes;
use InvalidArgumentException;

class PaymentTypeValue
{
    private string $value;

    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    private function validate(string $value): void
    {
        if (!PaymentTypes::tryFrom($value)) {
            throw new InvalidArgumentException('Invalid payment type', 400);
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
