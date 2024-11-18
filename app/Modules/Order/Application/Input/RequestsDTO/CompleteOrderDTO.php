<?php

namespace App\Modules\Order\Application\Input\RequestsDTO;

use App\Modules\Common\Domain\ValueObjects\IdValue;

class CompleteOrderDTO
{
    public function __construct(public readonly IdValue $id) {}
}
