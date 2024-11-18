<?php

namespace App\Modules\Payment\Application\Exceptions;

class PaymentRepositoryException extends PaymentException
{
    const CODE_ERROR_UPDATE_STATUS = 1;

    public static array $messages = [
        self::CODE_ERROR_UPDATE_STATUS => 'Error update status',
    ];

    protected static array $httpStatuses = [
        self::CODE_ERROR_UPDATE_STATUS => 500,
    ];
}
