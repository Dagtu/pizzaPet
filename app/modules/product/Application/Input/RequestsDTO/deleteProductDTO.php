<?php

namespace App\modules\product\Application\Input\RequestsDTO;

class deleteProductDTO
{
    public function __construct(
        public int $id
    ) {}
}
