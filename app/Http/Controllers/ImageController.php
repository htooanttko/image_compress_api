<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
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
        $blogs = $this->imageService->getImages();
        return ResponseHelper::success($blogs);
    }

    public function show($id)
    {
        $blog = $this->imageService->getImageById($id);
        return $blog ? ResponseHelper::success($blog) : ResponseHelper::error('Image not found', 404);
    }
}
