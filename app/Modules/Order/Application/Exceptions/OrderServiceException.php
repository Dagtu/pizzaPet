<?php

namespace App\Modules\Order\Application\Exceptions;

class OrderServiceException extends OrderException
{
    const CODE_PRODUCT_OUT_OF_STOCK = 1;
    const CODE_PRICE_PRODUCT_CHANGED = 2;
    const CODE_PAYMENT_FAILED = 3;
    const CODE_COURIER_FAILED = 4;
    const CODE_FAILED_UPDATE_ORDER_STATUS = 5;
    const CODE_FAILED_COMPLETE_ORDER = 6;

    public static array $messages = [
        self::CODE_PRODUCT_OUT_OF_STOCK => 'Product out of stock',
        self::CODE_PRICE_PRODUCT_CHANGED => 'Product price changed',
        self::CODE_PAYMENT_FAILED => 'Payment failed',
        self::CODE_COURIER_FAILED => 'Courier failed',
        self::CODE_FAILED_UPDATE_ORDER_STATUS => 'Failed update order status',
        self::CODE_FAILED_COMPLETE_ORDER => 'Failed complete order',
    ];

    protected static array $httpStatuses = [
        self::CODE_PRODUCT_OUT_OF_STOCK => 409,
        self::CODE_PRICE_PRODUCT_CHANGED => 409,
        self::CODE_PAYMENT_FAILED => 402,
        self::CODE_COURIER_FAILED => 503,
        self::CODE_FAILED_UPDATE_ORDER_STATUS => 500,
        self::CODE_FAILED_COMPLETE_ORDER => 500,
    ];
}
