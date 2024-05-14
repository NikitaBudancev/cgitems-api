<?php

namespace App\Http\Controllers\Api\Auth;

use App\Facades\Api\ApiResponse;
use App\Http\Requests\Api\Auth\VerificationRequest;
use App\Listeners\Users\SendVerificationEmail;
use App\Models\User;
use App\Services\Api\Users\VerificationUserService;
use Illuminate\Http\JsonResponse;

class VerificationController
{
    /**
     * Verify user by email token.
     */
    public function verify(VerificationRequest $request, VerificationUserService $verificationUserService): JsonResponse
    {
        $verificationUserService->verifyByEmailToken($request->token);

        return ApiResponse::success()->respond();
    }

    /**
     * Notify user to verify email if not verified yet.
     */
    public function notify(): JsonResponse
    {
        $user = auth()->user();

        if ($user instanceof User && ! $user->is_verified) {
            event(new SendVerificationEmail($user));

            return ApiResponse::success()->respond();
        }

        return ApiResponse::error()->respond();
    }
}
