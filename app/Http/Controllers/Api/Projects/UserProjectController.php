<?php

namespace App\Http\Controllers\Api\Projects;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Project\ProjectResource;
use App\Http\Resources\Api\Project\ProjectsResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserProjectController extends Controller
{
    public function __construct(
        private readonly ProjectRepositoryContract $projectRepository
    ) {
    }

    public function index(User $user)
    {
        $projects = $this->projectRepository->getPublishedUserProjects($user->id);

        return ApiResponse::success(ProjectsResource::collection($projects))->respond();
    }

    public function show(User $user, $slug): JsonResponse
    {
        $project = $this->projectRepository->getPublishedUserProject($user->id, $slug);

        return ApiResponse::success(new ProjectResource($project))->respond();
    }
}
