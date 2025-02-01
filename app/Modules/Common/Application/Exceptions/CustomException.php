<?php

namespace App\Modules\Common\Application\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected int $internalCode;

    protected static array $messages = [];
    protected static array $httpStatuses = [];

    public function __construct(int $code, ?string $additionalMessage = null)
    {
        $message = static::$messages[$code] ?? 'Unknown error';
        if ($additionalMessage) {
            $message .= $additionalMessage;
        }

        $this->internalCode = $code;

        parent::__construct($message, static::$httpStatuses[$code] ?? 500);
    }

    public function getInternalCode(): int
    {
        return $this->internalCode;
    }
}
