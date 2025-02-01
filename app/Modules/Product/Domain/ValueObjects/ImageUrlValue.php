<?php

namespace App\Modules\Product\Domain\ValueObjects;

use InvalidArgumentException;

class ImageUrlValue
{
    private string $imageUrl;

    public function __construct(string $imageUrl)
    {
        $this->validateValue($imageUrl);
        $this->imageUrl = $imageUrl;
    }

    private function validateValue(string $value): void
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
