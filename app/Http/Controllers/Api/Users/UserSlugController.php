<?php

namespace App\Http\Controllers\Api\Users;

use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;

class UserSlugController extends Controller
{
    public function __invoke(User $user)
    {
        return ApiResponse::success(new UserResource($user))->respond();
    }
}
