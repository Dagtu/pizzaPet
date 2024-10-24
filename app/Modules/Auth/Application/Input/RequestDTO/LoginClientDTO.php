<?php

namespace App\Modules\Auth\Application\Input\RequestDTO;

use App\Modules\Auth\Domain\ValueObjects\EmailValue;
use App\Modules\Auth\Domain\ValueObjects\PasswordValue;
use App\Modules\Auth\Domain\ValueObjects\PhoneValue;

class LoginClientDTO
{
    public function __construct(
        public PhoneValue|null $phone,
        public EmailValue|null $email,
        public PasswordValue $password
    ) {}

    public function getEmail(): ?string
    {
        return !is_null($this->email) ? $this->email->getValue() : null;
    }

    public function getPhone(): ?string
    {
        return !is_null($this->phone) ? $this->phone->getValue() : null;
    }

    public function getPassword(): ?string
    {
        return $this->password->getValue();
    }
}
