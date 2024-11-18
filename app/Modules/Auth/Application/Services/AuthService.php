<?php

namespace App\Modules\Auth\Application\Services;

use App\Modules\Auth\Application\Exceptions\InvalidCredentialsException;
use App\Modules\Auth\Application\Input\RequestDTO\LoginAdminDTO;
use App\Modules\Auth\Application\Input\RequestDTO\LoginClientDTO;
use App\Modules\Auth\Application\Ports\AuthRepositoryInterface;
use App\Modules\Auth\Application\Ports\TokenGeneratorInterface;
use App\Modules\Auth\Domain\Enums\Abilities;
use App\Modules\Auth\Domain\Enums\Guards;

class AuthService
{
    public function __construct(
        private readonly AuthRepositoryInterface $authRepository,
        private readonly TokenGeneratorInterface $tokenGenerator
    ) {}

    /**
     * @throws InvalidCredentialsException
     */
    public function loginClient(LoginClientDTO $loginClientDTO): string
    {
        if (!is_null($loginClientDTO->email)) {
            $user = $this->authRepository->findByEmail(
                $loginClientDTO->getEmail(),
                $loginClientDTO->getPassword(),
                Guards::Web->value
            );
        } else {
            $user = $this->authRepository->findByPhone(
                $loginClientDTO->getPhone(),
                $loginClientDTO->getPassword(),
                Guards::Web->value
            );
        }

        if (!$user) {
            throw new InvalidCredentialsException('Invalid credentials', 401);
        }

        return $this->tokenGenerator->generateToken($user, [Abilities::Client]);
    }

    /**
     * @throws InvalidCredentialsException
     */
    public function loginAdmin(LoginAdminDTO $loginAdminDTO): string
    {
        $user = $this->authRepository->findByEmail(
            $loginAdminDTO->getEmail(),
            $loginAdminDTO->getPassword(),
            Guards::WebAdmin->value
        );

        if (!$user) {
            throw new InvalidCredentialsException('Invalid credentials', 401);
        }

        return $this->tokenGenerator->generateToken($user, [Abilities::Admin]);
    }
}
