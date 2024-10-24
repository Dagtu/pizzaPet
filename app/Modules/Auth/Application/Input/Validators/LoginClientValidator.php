<?php

namespace App\Modules\Auth\Application\Input\Validators;

use App\Modules\Auth\Application\Exceptions\LoginClientInputException;
use App\Modules\Auth\Application\Input\RequestDTO\LoginClientDTO;

class LoginClientValidator
{
    /**
     * @throws LoginClientInputException
     */
    public function validate(LoginClientDTO $loginClientDTO): void
    {
        if (is_null($loginClientDTO->email) && is_null($loginClientDTO->phone)) {
            throw new LoginClientInputException('There is no login for authorization');
        }
    }
}
