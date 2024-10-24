<?php

namespace App\Modules\Product\Domain\Entities;

class ProductEntity
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $type,
        public readonly bool $isActive,
        public readonly float $price,
        public readonly string $imageUrl,
        public readonly string $description
    ) {}
}
