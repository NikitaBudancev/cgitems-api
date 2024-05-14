<?php

namespace App\Services\Api\Media;

use App\Models\Media;

class CreateMediaService
{
    public function create(string $name, string $type, int $modelId, string $modelType): Media
    {
        return Media::query()->create([
            'name' => $name,
            'type' => $type,
            'model_id' => $modelId,
            'model_type' => $modelType,
        ]);
    }
}
