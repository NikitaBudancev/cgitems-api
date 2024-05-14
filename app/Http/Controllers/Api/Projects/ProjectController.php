<?php

namespace App\Http\Controllers\Api\Projects;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Project\ProjectCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectRepositoryContract $projectRepository
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $perPage = $request->get('perPage', 20);
        $projects = $this->projectRepository->getAllWithPaginate($perPage);

        return ApiResponse::success(new ProjectCollection($projects))->respond();
    }
}
