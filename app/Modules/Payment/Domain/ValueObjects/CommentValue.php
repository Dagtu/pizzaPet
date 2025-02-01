<?php

namespace App\Modules\Payment\Domain\ValueObjects;

use InvalidArgumentException;

class CommentValue
{
    private string $value;

    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    private function validate(string $value): void
    {
        if (!preg_match('/^[А-яA-z.,!?:"\s]+$/u', $value)) {
            throw new InvalidArgumentException('Description contains invalid characters', 400);
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
