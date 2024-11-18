<?php

namespace App\Modules\Auth\Application\Input\RequestDTO;

use App\Modules\Auth\Domain\ValueObjects\EmailValue;
use App\Modules\Auth\Domain\ValueObjects\PasswordValue;

class LoginAdminDTO
{
    public function __construct(
        public readonly EmailValue $email,
        public readonly PasswordValue $password
    ) {}

    public function getEmail(): ?string
    {
        return $this->email->getValue();
    }

    public function getPassword(): ?string
    {
        return $this->password->getValue();
    }
}
