<?php

namespace App\Services\Api\Projects;

use App\DTO\Media\MediaDto;
use App\DTO\Projects\UpdateProjectDto;
use App\Facades\Api\ApiMediaManager;
use App\Models\Project;
use App\Models\ProjectStage;
use App\Repositories\ProjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateProjectService
{
    public function __construct(
        public CreateStageService $createStageService
    ) {
    }

    /**
     * @throws Exception
     */
    public function update(
        UpdateProjectDto $projectDto,
        ProjectRepository $projectRepository,
    ): Project {
        DB::beginTransaction();

        try {
            $project = $projectRepository->getProject($projectDto->id);

            $projectStage = $this->createStageService->create(
                $projectDto->stageId,
                $project->id
            );

            $project->update(['current_stage_id' => $projectStage->id]);

            $previewDto = MediaDto::fromArray([
                'type' => 'preview',
                'modelId' => $projectStage->id,
                'modelType' => ProjectStage::class,
            ], false);

            $imageDto = MediaDto::fromArray([
                'type' => 'image',
                'modelId' => $projectStage->id,
                'modelType' => ProjectStage::class,
            ], false);

            //        DB::rollBack();

            $previewUploaded = $projectDto->preview;

            ApiMediaManager::setMedia($previewDto)->create($previewUploaded);

            $images = $projectDto->media;

            foreach ($images as $uploadImage) {
                ApiMediaManager::setMedia($imageDto)->create($uploadImage);
            }

            DB::commit();

            return $project;
        } catch (Exception $exception) {
            DB::rollBack();
            //            throw $exception;
        }
    }

    protected function generateUniqueSlug(string $name): string
    {
        $slug = $baseSlug = Str::slug($name);
        $counter = 1;

        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
