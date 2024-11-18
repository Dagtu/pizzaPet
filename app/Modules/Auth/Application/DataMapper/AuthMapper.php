<?php

namespace App\Modules\Auth\Application\DataMapper;

use App\Modules\Auth\Application\Input\RequestDTO\LoginAdminDTO;
use App\Modules\Auth\Application\Input\RequestDTO\LoginClientDTO;
use App\Modules\Auth\Domain\ValueObjects\EmailValue;
use App\Modules\Auth\Domain\ValueObjects\PasswordValue;
use App\Modules\Common\Domain\ValueObjects\PhoneValue;

class AuthMapper
{
    public function mapLoginClientDTOFromRequest(
        string $password,
        ?string $phone = null,
        ?string $email = null
    ): LoginClientDTO
    {
        return new LoginClientDTO(
            new PasswordValue($password),
            $phone ? new PhoneValue($phone) : null,
            $email ? new EmailValue($email) : null
        );
    }

    public function mapLoginAdminDTOFromRequest(string $email, string $password): LoginAdminDTO
    {
        return new LoginAdminDTO(new EmailValue($email), new PasswordValue($password));
    }
}
