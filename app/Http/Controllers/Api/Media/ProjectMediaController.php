<?php

namespace App\Http\Controllers\Api\Media;

use App\DTO\Media\MediaDto;
use App\DTO\Media\ProjectMediaDtoGenerator;
use App\Facades\Api\ApiMediaManager;
use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Media\StoreRequest;
use App\Http\Requests\Api\Media\UpdateRequest;
use App\Models\Media;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProjectMediaController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        $this->authorize('create', Project::class);

        $mediaDto = ProjectMediaDtoGenerator::fromAttributes($request->type, $request->modelId);
        $uploadedFile = $request->file('file');

        $media = ApiMediaManager::setMedia($mediaDto)->create($uploadedFile);

        return ApiResponse::success(ApiMediaManager::transform($media))
            ->respond(ResponseAlias::HTTP_CREATED);
    }

    public function update(UpdateRequest $request, Media $media): JsonResponse
    {
        $this->authorize('update', $media);

        $mediaDto = MediaDto::fromModel($media);
        $uploadedFile = $request->file('file');

        $updatedMedia = ApiMediaManager::setMedia($mediaDto)->update($uploadedFile);

        return ApiResponse::success(ApiMediaManager::transform($updatedMedia))
            ->respond();
    }

    public function destroy(Media $media): JsonResponse
    {
        $this->authorize('update', $media);

        $mediaDto = MediaDto::fromModel($media);
        ApiMediaManager::setMedia($mediaDto)->delete();

        return ApiResponse::success()->respond();
    }
}
