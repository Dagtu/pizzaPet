<?php

namespace App\Modules\Order\Application\Exceptions;

class OrderRepositoryException extends OrderException
{
    const CODE_ERROR_CREATING_ORDER = 1;
    const CODE_ERROR_COMPLETING_ORDER = 2;
    const CODE_ERROR_ORDER_NOT_FOUND = 3;

    public static array $messages = [
        self::CODE_ERROR_CREATING_ORDER => 'Error creating order',
        self::CODE_ERROR_COMPLETING_ORDER => 'Error completing order',
        self::CODE_ERROR_ORDER_NOT_FOUND => 'Order not found',
    ];

    protected static array $httpStatuses = [
        self::CODE_ERROR_CREATING_ORDER => 500,
        self::CODE_ERROR_COMPLETING_ORDER => 500,
        self::CODE_ERROR_ORDER_NOT_FOUND => 404,
    ];
}
