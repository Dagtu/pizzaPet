<?php

namespace App\Modules\Auth\Application\DataMapper;

use App\Modules\Auth\Application\Input\RequestDTO\LoginAdminDTO;
use App\Modules\Auth\Application\Input\RequestDTO\LoginClientDTO;
use App\Modules\Auth\Domain\ValueObjects\EmailValue;
use App\Modules\Auth\Domain\ValueObjects\PasswordValue;
use App\Modules\Auth\Domain\ValueObjects\PhoneValue;

class AuthMapper
{
    public function mapLoginClientDTOFromRequest(string|null $phone, string|null $email, string $password): LoginClientDTO
    {
        $phoneValue = !is_null($phone) ? new PhoneValue($phone) : null;
        $emailValue = !is_null($email) ? new EmailValue($email) : null;
        $passwordValue = new PasswordValue($password);

        return new LoginClientDTO($phoneValue, $emailValue, $passwordValue);
    }

    public function mapLoginAdminDTOFromRequest(string $email, string $password): LoginAdminDTO
    {
        return new LoginAdminDTO(new EmailValue($email), new PasswordValue($password));
    }
}
