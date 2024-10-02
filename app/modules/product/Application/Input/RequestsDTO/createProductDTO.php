<?php

namespace App\modules\product\Application\Input\RequestsDTO;

class createProductDTO
{
    public function __construct(
        public string $name,
        public string $type,
        public bool $isActive,
        public float $price,
        public string $imageUrl,
        public string $description
    ) {}
}
