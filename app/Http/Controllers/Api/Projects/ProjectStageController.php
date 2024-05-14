<?php

namespace App\Http\Controllers\Api\Projects;

use App\DTO\Projects\Stages\CreateProjectStageDto;
use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Projects\Stages\StoreRequest;
use App\Models\ProjectStage;
use App\Services\Api\Projects\CreateStageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProjectStageController extends Controller
{
    public function __construct(
        private readonly CreateStageService $projectStageService,
    ) {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws Exception
     */
    public function store(StoreRequest $request): JsonResponse
    {

        $this->authorize('create', ProjectStage::class);

        $projectStageDto = CreateProjectStageDto::fromRequest($request);
        $projectStage = $this->projectStageService->create($projectStageDto, $projectStageDto->projectId);

        return ApiResponse::success($projectStage)
            ->respond(ResponseAlias::HTTP_CREATED);
    }
}
