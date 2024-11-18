<?php

namespace App\Modules\Payment\Application\Exceptions;

class PaymentServiceException extends PaymentException
{
    const CODE_PAYMENT_FAILED = 1;
    const CODE_ERROR_UPDATE_STATUS = 2;

    public static array $messages = [
        self::CODE_PAYMENT_FAILED => 'Payment failed',
        self::CODE_ERROR_UPDATE_STATUS => 'Error updating status',
    ];

    protected static array $httpStatuses = [
        self::CODE_PAYMENT_FAILED => 402,
        self::CODE_ERROR_UPDATE_STATUS => 500,
    ];
}
