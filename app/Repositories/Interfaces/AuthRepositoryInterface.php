<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function createUser(array $data): User;
    public function findUserByEmail(string $email): ?User;
}
