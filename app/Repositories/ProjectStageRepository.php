<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProjectStageRepositoryContract;
use App\Models\ProjectStage;
use Illuminate\Database\Eloquent\Model;

class ProjectStageRepository extends CoreRepository implements ProjectStageRepositoryContract
{
    public function __construct(ProjectStage $model)
    {
        parent::__construct($model);
    }

    public function getProjectStage(int $id): ?Model
    {
        return $this->findWithColumns($id);
    }

    public function findActiveStage(int $projectId): ?Model
    {
        return $this->createQuery()->where('project_id', $projectId)
            ->orderBy('stage_id', 'desc')
            ->first();
    }
}
