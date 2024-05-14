<?php

namespace App\Http\Controllers\Api\Stages;

use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Project\ProjectStageResource;
use App\Models\Stage;
use Illuminate\Http\JsonResponse;

class StageController extends Controller
{
    public function __construct(

    ) {
    }

    public function index(): JsonResponse
    {
        return ApiResponse::success(ProjectStageResource::collection(Stage::all()))->respond();
    }
}
