<?php

namespace App\Modules\Product\Application\Input\RequestsDTO;

use App\Modules\Common\Domain\ValueObjects\IdValue;

class DeleteProductDTO
{
    public function __construct(public readonly IdValue $id) {}

    public function getId(): int
    {
        return $this->id->getValue();
    }
}
