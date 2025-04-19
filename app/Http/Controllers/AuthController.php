<?php

namespace App\Http\Controllers;

use App\DTOs\AuthDTO;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $authDTO = AuthDTO::fromRegisterRequest($request->validated());
        $data = $this->authService->register($authDTO);

        return ResponseHelper::success($data, status: 201);
    }

    public function login(LoginRequest $request)
    {
        $AuthDTO = AuthDTO::fromLoginRequest($request->validated());
        $data = $this->authService->login($AuthDTO);

        return ResponseHelper::success($data);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return ResponseHelper::success("logout");
    }
}
