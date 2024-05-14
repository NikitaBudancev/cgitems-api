<?php

namespace App\Services\Api\Media\Image;

use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class ImageProcessor
{
    private string $imagePath;

    private Image $file;

    public function setImage($imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function scale($disk, $fileName, $width, $height): bool
    {
        try {
            $this->initFileManager($this->imagePath);

            $this->file->scale($width, $height);

            return Storage::disk($disk)->put($fileName, $this->file->encode());
        } catch (Exception $exception) {
            return false;
        }

        //        $newFileNameAvif = str_replace($this->getExtensionFromPath($fileName), 'avif', $fileName);
        //        Storage::disk('resize')->put($newFileNameAvif, $this->toExtensionFile($newFileNameAvif));

        //        $newFileNameWebp = str_replace($this->getExtensionFromPath($fileName), 'webp', $fileName);
        //        Storage::disk('resize')->put($newFileNameWebp, $this->toExtensionFile($newFileNameWebp));
    }

    private function initFileManager($imagePath): void
    {
        try {
            $manager = ImageManager::gd();
            $this->file = $manager->read($imagePath);
        } catch (Exception $exception) {
            logger()->error($exception->getMessage());
        }
    }
}
