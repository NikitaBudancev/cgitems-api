<?php

namespace App\Http\Controllers\Api\Projects;

use App\DTO\Projects\CreateProjectDto;
use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Projects\StoreRequest;
use App\Http\Resources\Api\Project\Profile\ProjectResource;
use App\Http\Resources\Api\Project\Profile\ProjectsResource;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Services\Api\Projects\CreateProjectService;
use Exception;
use Illuminate\Http\JsonResponse;

class ProfileProjectController extends Controller
{
    public function __construct(
        private readonly ProjectRepository $projectRepository
    ) {
    }

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Project::class);

        $userId = auth()->id();
        $projects = $this->projectRepository->getAllUserProjects($userId);

        return ApiResponse::success(ProjectsResource::collection($projects))->respond();
    }

    public function show($slug): JsonResponse
    {
        $project = $this->projectRepository->getProjectBySlug($slug);

        $this->authorize('view', $project);

        return ApiResponse::success(new ProjectResource($project))->respond();
    }

    /**
     * @throws Exception
     */
    public function store(StoreRequest $request, CreateProjectService $createProjectService): JsonResponse
    {
        $this->authorize('create', Project::class);

        $projectDto = CreateProjectDto::fromRequest($request, false);
        $project = $createProjectService->create($projectDto);

        return ApiResponse::success(new ProjectResource($project))->respond();
    }
}
