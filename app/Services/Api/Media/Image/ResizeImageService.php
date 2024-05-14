<?php

namespace App\Services\Api\Media\Image;

use App\DTO\Media\MediaDto;
use App\Services\Api\Media\File\FileHelper;
use Illuminate\Support\Facades\Storage;

class ResizeImageService
{
    private string $cacheDisk;

    private string $imageDisc;

    private string $imagePath;

    public function __construct(
        private readonly ImageProcessor $imageProcessor
    ) {
        $this->cacheDisk = config('media.disk.cache');
        $this->imageDisc = config('media.disk.image');
    }

    public function renderMediaResource(MediaDto $media, $config): array
    {
        $this->imagePath = FileHelper::getFullPath($this->imageDisc, $config['folder'], $media->name);

        if (! file_exists($this->imagePath)) {
            return [];
        }

        $pubicFullPath = FileHelper::getFullPublicPath(
            $this->imageDisc,
            $config['folder'],
            $media->name
        );

        $sizes = $config['sizes'];
        $originalPath = ['original' => $pubicFullPath];

        $pathsImageResized = array_map(function ($size) {
            return $this->getPathResizeImage($size['width'], $size['height']);
        }, $sizes);

        return array_merge($originalPath, $pathsImageResized);
    }

    private function getPathResizeImage(int $width = 100, int $height = 100): ?string
    {
        $imageName = $this->renderResizeImageName($width, $height);
        $fullPathImage = Storage::disk($this->cacheDisk)->url('') . $imageName;

        if (Storage::disk($this->cacheDisk)->exists($imageName)) {
            return $fullPathImage;
        }

        $this->imageProcessor
            ->setImage($this->imagePath)
            ->scale($this->cacheDisk, $imageName, $width, $height);

        return $fullPathImage;
    }

    private function renderResizeImageName($width, $height): string
    {
        $fileName = FileHelper::getFileNameWithoutExtension($this->imagePath);
        $extension = FileHelper::getFileExtension($this->imagePath);

        return "{$fileName}_{$width}x{$height}.{$extension}";
    }
}
