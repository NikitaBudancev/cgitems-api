<?php

namespace App\Http\Controllers\Api\Projects;

use App\Facades\Api\ApiResponse;
use App\Repositories\ProjectRepository;
use Illuminate\Http\JsonResponse;

class UserReviewController
{
    public function index($id, ProjectRepository $projectRepository): JsonResponse
    {
        $reviews = $projectRepository->getReviewsByUserId($id);

        return ApiResponse::success($reviews)->respond();
    }
}
