<?php

namespace App\Services;

use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageService
{
    private ImageRepositoryInterface $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function getImages()
    {
        return $this->imageRepository->getAll();
    }

    public function getImageById(int $id)
    {
        return $this->imageRepository->findById($id);
    }
}
