<?php

namespace App\Services\Api\Projects;

use App\DTO\Projects\CreateProjectDto;
use App\Events\Projects\ProjectCreated;
use App\Models\Project;
use App\Services\Api\Utils\SlugService;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateProjectService
{
    public function __construct(
        public CreateStageService $createStageService,
        public SlugService $slugService
    ) {
    }

    /**
     * @throws Exception
     */
    public function create(
        CreateProjectDto $projectDto,
    ): Project {
        DB::beginTransaction();

        try {
            $createdProject = Project::create([
                'name' => $projectDto->name,
                'slug' => $this->slugService->generateUniqueSlug($projectDto->name, Project::class),
                'user_id' => auth()->id(),
                'project_description' => $projectDto->projectDescription,
                'project_type_id' => $projectDto->projectTypeId,
                'published' => true,
            ]);

            $this->createStageService->create(
                $projectDto,
                $createdProject->id
            );

            DB::commit();

            event(new ProjectCreated($createdProject));

            return $createdProject;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
