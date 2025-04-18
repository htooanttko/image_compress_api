<?php

namespace App\Repositories;

use App\Models\Image;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    public function getAll()
    {
        return Image::all();
    }

    public function findById(int $id): ?Image
    {
        return Image::find($id);
    }
}
