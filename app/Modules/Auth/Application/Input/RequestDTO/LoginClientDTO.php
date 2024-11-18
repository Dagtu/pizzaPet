<?php

namespace App\Modules\Auth\Application\Input\RequestDTO;

use App\Modules\Auth\Domain\ValueObjects\EmailValue;
use App\Modules\Auth\Domain\ValueObjects\PasswordValue;
use App\Modules\Common\Domain\ValueObjects\PhoneValue;

class LoginClientDTO
{
    public function __construct(
        public readonly PasswordValue $password,
        public readonly ?PhoneValue $phone = null,
        public readonly ?EmailValue $email = null,
    ) {}

    public function getEmail(): ?string
    {
        return $this->email?->getValue();
    }

    public function getPhone(): ?string
    {
        return $this->phone?->getValue();
    }

    public function getPassword(): ?string
    {
        return $this->password->getValue();
    }
}
