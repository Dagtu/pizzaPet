<?php

namespace App\Modules\Product\Domain\Entities;

class ProductEntity
{
    public function __construct(
        public int $id,
        public string $name,
        public string $type,
        public bool $isActive,
        public float $price,
        public string $imageUrl,
        public string $description
    ) {}
}
