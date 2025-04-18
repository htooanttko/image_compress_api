<?php

namespace App\Repositories\Interfaces;

use App\Models\Blog;
use App\Models\Image;

interface ImageRepositoryInterface
{
    // public function create(array $data): Blog;
    public function getAll();
    public function findById(int $id): ?Image;
}
