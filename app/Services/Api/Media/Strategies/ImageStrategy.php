<?php

namespace App\Services\Api\Media\Strategies;

use App\Models\Media;
use App\Services\Api\Media\CreateMediaService;
use App\Services\Api\Media\File\SaveFileService;
use App\Services\Api\Media\Image\ResizeImageService;
use Exception;

class ImageStrategy extends CoreStrategy
{
    public function __construct(
        private readonly ResizeImageService $resizeImageService,
        private readonly SaveFileService $saveFileService,
        private readonly CreateMediaService $createMediaService
    ) {
    }

    public function get(): array
    {
        return $this->resizeImageService->renderMediaResource(
            $this->getMedia(),
            $this->getConfig()
        );
    }

    /**
     * @throws Exception
     */
    public function create(mixed $payload): Media
    {
        $fileName = $this->saveFileService->save($this->getConfig(), $payload);
        $media = $this->getMedia();

        return $this->createMediaService->create(
            $fileName,
            $media->type,
            $media->modelId,
            $media->modelType
        );
    }

    public function update(mixed $payload): Media
    {
        return Media::find(1);
    }

    public function delete(): bool
    {
        return true;
    }
}
