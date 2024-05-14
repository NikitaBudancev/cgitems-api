<?php

namespace App\Services\Api\Media;

use App\Models\Media;

class UpdateMediaService
{
    public function update(
        int $id,
        ?string $name,
        ?string $type,
        ?int $modelId,
        ?string $modelType
    ): ?Media {
        $media = Media::find($id);

        if (! $media) {
            return null;
        }

        $params = [
            'name' => $name,
            'type' => $type,
            'model_id' => $modelId,
            'model_type' => $modelType,
        ];

        $dataToUpdate = array_filter($params, function ($value) {
            return ! is_null($value);
        });

        $media->update($dataToUpdate);

        return $media;
    }
}
