<?php

namespace App\Modules\Product\Application\Exceptions;

class ProductServiceException extends ProductException
{
    const CODE_PRODUCT_NOT_FOUND = 1;
    const CODE_ERROR_DELETE_PRODUCT = 2;

    public static array $messages = [
        self::CODE_PRODUCT_NOT_FOUND => 'Product not found',
        self::CODE_ERROR_DELETE_PRODUCT => 'Error deleting product',
    ];

    protected static array $httpStatuses = [
        self::CODE_PRODUCT_NOT_FOUND => 404,
        self::CODE_ERROR_DELETE_PRODUCT => 500,
    ];
}
