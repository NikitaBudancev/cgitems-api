<?php

namespace App\Http\Controllers\Api\Auth;

use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        Auth::logout();

        return ApiResponse::success()->respond();
    }
}
