<?php

namespace App\DTO\Media;

use App\Models\User;
use Illuminate\Http\Request;

class UserMediaDtoGenerator
{
    public static function fromRequest(Request $request): MediaDto
    {
        $dto = new MediaDto();

        $dto->type = $request->type;
        $dto->modelId = $request->modelId;
        $dto->modelType = User::class;

        return $dto;
    }
}
