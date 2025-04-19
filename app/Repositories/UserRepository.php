<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::with([
            'images:id,user_id,original_filepath,compressed_filepath,format',
            'images.logs:id,image_id,message,status,created_at',
        ])
            ->withCount(['images'])
            ->latest()
            ->get();
    }

    public function findById(int $id): ?User
    {
        return User::with([
            'images:id,user_id,original_filepath,compressed_filepath',
            'images.logs:id,image_id,message,status,created_at',
        ])
            ->withCount(['images'])
            ->findOrFail($id);
    }
}
