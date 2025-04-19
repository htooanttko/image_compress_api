<?php

namespace App\Repositories;

use App\Models\CompressionLog;
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

    public function compressImage(array $data): Image
    {
        $image = Image::create($data);

        CompressionLog::create([
            'image_id'   => $image->id,
            'api_key_id' => $data['api_key_id'],
            'status'     => 'success',
            'message'    => 'Image compressed successfully',
        ]);

        return $image;
    }

    public function logFailedCompressImage(string $errorMsg): void
    {
        CompressionLog::create([
            'image_id'   => null, // no image created
            'status'     => 'failed',
            'message'    => $errorMsg,
        ]);
    }
}
