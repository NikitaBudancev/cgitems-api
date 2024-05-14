<?php

namespace App\Services\Api\Projects;

use App\DTO\Media\ProjectMediaDtoGenerator;
use App\Facades\Api\ApiMediaManager;
use Illuminate\Http\UploadedFile;

class CreateProjectMediaService
{
    public function create(int $projectStageId, string $mediaType, array|UploadedFile $upload): array
    {

        $mediaDto = ProjectMediaDtoGenerator::fromAttributes(
            $mediaType,
            $projectStageId
        );

        $files = is_iterable($upload) ? $upload : [$upload];

        return array_map(function ($file) use ($mediaDto) {
            return ApiMediaManager::setMedia($mediaDto)->create($file);
        }, $files);
    }
}
