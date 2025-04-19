<?php

namespace App\Services;

use App\DTOs\ImageDTO;
use App\Helpers\EncodeHelper;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class ImageService
{
    private ImageRepositoryInterface $imageRepository;
    private $imageManager;

    public function __construct(ImageRepositoryInterface $imageRepository, ImageManager $imageManager)
    {
        $this->imageRepository = $imageRepository;
        $this->imageManager = $imageManager;
    }

    public function getImages()
    {
        return $this->imageRepository->getAll();
    }

    public function getImageById(int $id)
    {
        return $this->imageRepository->findById($id);
    }

    public function createCompressImage(ImageDTO $imageDTO, int $userId)
    {
        $format = $imageDTO->format ?? 'jpg';
        $quality = $imageDTO->quality ?? 70;
        $resizeWidth = $imageDTO->width ?? null;
        $resizeHeight = $imageDTO->height ?? null;
        $file = $imageDTO->image;

        $originalName = $file->getClientOriginalName();
        $originalSize = $file->getSize();
        $originalPath = $file->store("images/originals");

        try {
            $image = $this->imageManager->read($file->getPathname());

            if ($resizeWidth || $resizeHeight) {
                $image->resize($resizeWidth, $resizeHeight);
            }

            $encoder = EncodeHelper::get($format, $quality);
            $encodedImage = $image->encode($encoder);

            $compressedFilename = pathinfo($originalName, PATHINFO_FILENAME) . "_compressed." . $format;
            $compressedPath = "images/compressed/" . $compressedFilename;

            Storage::put($compressedPath, $encodedImage->toString());
            $compressedSize = Storage::size($compressedPath);

            $imageRecord = $this->imageRepository->compressImage([
                'user_id'         => $userId,
                'original_filename'   => $originalName,
                'original_size'   => $originalSize,
                'original_filepath'   => $originalPath,

                'compressed_filename' => $compressedFilename,
                'compressed_size' => $compressedSize,
                'compressed_filepath' => $compressedPath,
            ]);

            return [
                'image_url' => Storage::url($compressedPath),
                'original_size' => $originalSize,
                'compressed_size' => $compressedSize,
                'format' => $format,
                'resolution' => [
                    'width' => $image->width(),
                    'height' => $image->height(),
                ],
                'saved' => $imageRecord,
            ];
        } catch (\Exception $e) {
            $this->imageRepository->logFailedCompressImage($e->getMessage());

            return [
                'error' => true,
                'message' => 'Image compression failed.',
                'reason' => $e->getMessage(),
            ];
        }
    }
}
