<?php

namespace App\Modules\Courier\Application\Exceptions;

class CourierServiceException extends CourierException
{
    const CODE_COURIER_NOT_FOUND = 1;
    const CODE_COURIER_ERROR_UPDATE_STATUS = 2;

    protected static array $messages = [
        self::CODE_COURIER_NOT_FOUND => 'No available couriers',
        self::CODE_COURIER_ERROR_UPDATE_STATUS => 'Courier error update status',
    ];

    protected static array $httpStatuses = [
        self::CODE_COURIER_NOT_FOUND => 404,
        self::CODE_COURIER_ERROR_UPDATE_STATUS => 500,
    ];
}
