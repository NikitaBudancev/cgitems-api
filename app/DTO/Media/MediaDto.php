<?php

namespace App\DTO\Media;

use App\DTO\CoreDto;
use App\Models\Media;

class MediaDto extends CoreDto
{
    public int $id;
    public string $name;
    public string $type;
    public int $modelId;
    public string $modelType;

    public static function fromModel(Media $media): MediaDto
    {
        $dto = new MediaDto();
        $dto->id = $media->id;
        $dto->name = $media->name;
        $dto->type = $media->type;
        $dto->modelId = $media->model_id;
        $dto->modelType = $media->model_type;
        return $dto;
    }
}
