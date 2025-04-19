<?php

namespace App\Http\Controllers;

use App\DTOs\ImageDTO;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ImageRequest;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $images = $this->imageService->getImages();
        return ResponseHelper::success($images);
    }

    public function show($id)
    {
        $image = $this->imageService->getImageById($id);
        return $image ? ResponseHelper::success($image) : ResponseHelper::error('Image not found', 404);
    }

    public function compress(ImageRequest $request)
    {
        $validated = $request->validated();
        $userId = $request->user()->id;

        $imageDTO = ImageDTO::fromRequest($validated, $userId);
        $image = $this->imageService->createCompressImage($imageDTO, $userId);

        return $image || (isset($image['error']) && !$image['error']) ? ResponseHelper::success($image) : ResponseHelper::error($image['message'], 500, $image['reason']);
    }
}
