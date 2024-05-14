<?php

namespace App\Services\Api\Projects;

use App\DTO\Projects\CreateProjectDto;
use App\DTO\Projects\Stages\CreateProjectStageDto;
use App\Enums\Media\MediaType;
use App\Models\ProjectStage;

class CreateStageService
{
    public function __construct(
        public CreateProjectMediaService $createProjectMediaService,
    ) {
    }

    public function create(CreateProjectDto|CreateProjectStageDto $projectDto, int $createdProjectId): ProjectStage
    {
        $projectStage = ProjectStage::create([
            'stage_id' => $projectDto->stageId,
            'project_id' => $createdProjectId,
        ]);

        $this->createProjectMediaService->create(
            $projectStage->id,
            MediaType::preview->name,
            $projectDto->preview
        );

        $this->createProjectMediaService->create(
            $projectStage->id,
            MediaType::image->name,
            $projectDto->media
        );

        return $projectStage;

    }
}
