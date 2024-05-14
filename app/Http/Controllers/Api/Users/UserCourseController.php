<?php

namespace App\Http\Controllers\Api\Users;

use App\Facades\Api\ApiResponse;
use App\Models\Course;
use Illuminate\Http\JsonResponse;

class UserCourseController
{
    public function index($id): JsonResponse
    {
        $courses = Course::query()
            ->whereRelation('projects', 'user_id', '=', $id)
            ->get();

        return ApiResponse::success($courses)->respond();
    }
}
