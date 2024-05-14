<?php

namespace App\DTO\Media;

use App\Models\ProjectStage;

class ProjectMediaDtoGenerator
{
    public static function fromAttributes(string $type, int $modelId): MediaDto
    {
        $dto = new MediaDto();

        $dto->type = $type;
        $dto->modelId = $modelId;
        $dto->modelType = ProjectStage::class;

        return $dto;
    }
}
