<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getUsers();
        return ResponseHelper::success($users);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return $user ? ResponseHelper::success($user) : ResponseHelper::error('User not found', 404);
    }
}
