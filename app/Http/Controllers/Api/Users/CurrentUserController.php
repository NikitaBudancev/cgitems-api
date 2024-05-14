<?php

namespace App\Http\Controllers\Api\Users;

use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CurrentUserController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $user = auth()->user();

        if ($user) {
            return ApiResponse::success(new UserResource($user))->respond();
        }

        return ApiResponse::error()->respond(ResponseAlias::HTTP_UNAUTHORIZED);
    }
}
