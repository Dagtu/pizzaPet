<?php

namespace App\Modules\Auth\Infrastructure\Http\Controllers;

use App\Modules\Auth\Application\DataMapper\AuthMapper;
use App\Modules\Auth\Application\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthMapper $authMapper,
        private readonly AuthService $authService
    ) {}

    public function loginClient(Request $request): JsonResponse
    {
        try {
            $loginClientDTO = $this->authMapper->mapLoginClientDTOFromRequest(
                $request->input('phone'),
                $request->input('email'),
                $request->input('password')
            );

            $token = $this->authService->loginClient($loginClientDTO);

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user_type' => 'client',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    public function loginAdmin(Request $request): JsonResponse
    {
        try {
            $loginAdminDTO = $this->authMapper->mapLoginAdminDTOFromRequest(
                $request->input('email'),
                $request->input('password')
            );

            $token = $this->authService->loginAdmin($loginAdminDTO);

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user_type' => 'admin',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
