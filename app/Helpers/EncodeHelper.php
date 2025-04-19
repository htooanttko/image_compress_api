<?php

namespace App\Helpers;

use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\WebpEncoder;

class EncodeHelper
{
    public static function get(string $format, int $quality)
    {
        return match (strtolower($format)) {
            'jpg', 'jpeg' => new JpegEncoder(quality: $quality),
            'png' => new PngEncoder(),
            'webp' => new WebpEncoder(quality: $quality),
            default => throw new \InvalidArgumentException("Unsupported image format: $format"),
        };
    }
}
