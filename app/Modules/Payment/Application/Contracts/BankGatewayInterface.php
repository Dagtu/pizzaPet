<?php

namespace App\Modules\Payment\Application\Contracts;

interface BankGatewayInterface
{
    public function send();
}
