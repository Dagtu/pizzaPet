<?php

namespace App\Modules\Order\Application\Input\RequestsDTO;

use App\Modules\Common\Domain\ValueObjects\IdValue;

class GetOrderDTO
{
    public function __construct(public readonly IdValue $clientId) {}
}
