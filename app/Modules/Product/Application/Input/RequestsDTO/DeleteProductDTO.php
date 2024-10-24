<?php

namespace App\Modules\Product\Application\Input\RequestsDTO;

use App\Modules\Product\Domain\ValueObjects\IdValue;

class DeleteProductDTO
{
    public function __construct(public IdValue $id) {}

    public function getId(): int
    {
        return $this->id->getValue();
    }
}
