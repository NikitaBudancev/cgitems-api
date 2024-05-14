<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface ProjectStageRepositoryContract
{
    public function getProjectStage(int $id): ?Model;

    public function findActiveStage(int $projectId);
}
