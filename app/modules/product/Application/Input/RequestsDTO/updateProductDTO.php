<?php

namespace App\modules\product\Application\Input\RequestsDTO;

class updateProductDTO
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
