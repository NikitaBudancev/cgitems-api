<?php

namespace App\Observers\Projects;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Contracts\Repositories\ProjectStageRepositoryContract;
use App\Models\ProjectStage;

readonly class ProjectStageObserver
{
    public function __construct(
        private ProjectRepositoryContract $projectRepository,
        private ProjectStageRepositoryContract $projectStageRepository,
    ) {
    }

    /**
     * Handle the ProjectStage "created" event.
     */
    public function created(ProjectStage $projectStage): void
    {
        $this->changeActiveProjectStage($projectStage->project_id);
    }

    /**
     * Handle the ProjectStage "deleted" event.
     */
    public function deleted(ProjectStage $projectStage): void
    {
        $this->changeActiveProjectStage($projectStage->project_id);
    }

    private function changeActiveProjectStage($projectId): void
    {
        $project = $this->projectRepository->getProject($projectId);
        $projectStage = $this->projectStageRepository->findActiveStage($projectId);

        $project->update(['current_stage_id' => $projectStage->id]);
    }
}
