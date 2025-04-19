<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class ImageDTO
{
    public function __construct(
        public int $userId,
        public ?string $format,
        public ?int $quality,
        public ?int $width,
        public ?int $height,
        public readonly UploadedFile $image,
    ) {}

    public static function fromRequest(array $data, int $userId): self
    {
        return new self(
            $userId,
            format: $data['format'] ?? null,
            quality: $data['quality'] ?? null,
            width: $data['width'] ?? null,
            height: $data['height'] ?? null,
            image: $data['image'],
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'format' => $this->format,
            'quality' => $this->quality,
            'width' => $this->width,
            'height' => $this->height,
            'image' => $this->image,
        ];
    }
}
