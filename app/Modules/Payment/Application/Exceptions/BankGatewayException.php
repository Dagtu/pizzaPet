<?php

namespace App\Modules\Payment\Application\Exceptions;

use App\Modules\Common\Application\Exceptions\CustomException;

class BankGatewayException extends CustomException
{
    const CODE_BANK_GATEWAY_ERROR = 1;

    public static array $messages = [
        self::CODE_BANK_GATEWAY_ERROR => 'Bank gateway error',
    ];

    protected static array $httpStatuses = [
        self::CODE_BANK_GATEWAY_ERROR => 502,
    ];
}
