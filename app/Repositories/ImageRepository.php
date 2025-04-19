<?php

namespace App\Repositories;

use App\Models\CompressionLog;
use App\Models\Image;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    public function getAll()
    {
        return Image::with('logs:id,image_id,message,status')->get();
    }

    public function findById(int $id): ?Image
    {
        return Image::with('logs:id,image_id,message,status,created_at')->find($id);
    }

    public function compressImage(array $data): Image
    {
        $image = Image::create($data);

        CompressionLog::create([
            'image_id'   => $image->id,
            'status'     => 'success',
            'message'    => 'Image compressed successfully',
        ]);

        return $image->load([
            'logs:id,image_id,message,status,created_at'
        ]);
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
