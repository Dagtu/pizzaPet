<?php

namespace App\Modules\Payment\Infrastructure\Gateway;

use App\Modules\Payment\Application\Contracts\BankGatewayInterface;
use App\Modules\Payment\Application\Exceptions\BankGatewayException;
use App\Modules\Payment\Domain\Enums\BankStatuses;

class BankGateway implements BankGatewayInterface
{
    /**
     * @throws BankGatewayException
     */
    public function send(): string
    {
        rand(1, 100) > 50 ? $result = BankStatuses::Success->value : $result = BankStatuses::Failed->value;

        if ($result === BankStatuses::Failed->value) {
            throw new BankGatewayException(BankGatewayException::CODE_BANK_GATEWAY_ERROR);
        }

        return $result;
    }
}
