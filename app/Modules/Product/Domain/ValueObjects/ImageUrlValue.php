<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class ImageUrlValue implements ValueObjectInterface
{
    private string $imageUrl;

    public function __construct(string $imageUrl)
    {
        $this->validateValue($imageUrl);
        $this->imageUrl = $imageUrl;
    }

    public function validateValue($value): void
    {
        if (!preg_match('/^https?:\/\/\S+$/', $value)) {
            throw new InvalidArgumentException('Invalid image URL format', 400);
        }
    }

    public function getValue(): string
    {
        return $this->imageUrl;
    }
}
