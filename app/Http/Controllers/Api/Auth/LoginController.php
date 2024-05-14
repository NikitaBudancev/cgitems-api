<?php

namespace App\Http\Controllers\Api\Auth;

use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginController extends Controller
{
    /**
     * Login the user.
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);
        $user = $this->authenticate($credentials);

        if (! $user) {
            return ApiResponse::error('error_login')
                ->respond(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        return ApiResponse::success(new UserResource($user))->respond();
    }

    /**
     * Attempt to authenticate the user.
     */
    private function authenticate(array $credentials): ?Authenticatable
    {
        return Auth::attempt($credentials) ? Auth::guard()->user() : null;
    }
}
