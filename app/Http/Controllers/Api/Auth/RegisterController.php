<?php

namespace App\Http\Controllers\Api\Auth;

use App\DTO\Users\RegisterUserDto;
use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Services\Api\Users\CreateUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class RegisterController extends Controller
{
    /**
     * Create Users.
     *
     * @throws Throwable
     */
    public function __invoke(RegisterRequest $request, CreateUserService $createUser): JsonResponse
    {

        $userDto = RegisterUserDto::fromRequest($request);
        $user = $createUser($userDto);

        if ($this->attemptAuthentication($request)) {

            return $this->createUserResponse($user);
        }

        return ApiResponse::error()->respond();
    }

    private function attemptAuthentication(RegisterRequest $request): bool
    {
        return Auth::attempt($request->only(['email', 'password']));
    }

    private function createUserResponse($user): JsonResponse
    {
        $userResource = new UserResource($user);

        return ApiResponse::success($userResource)->respond(ResponseAlias::HTTP_CREATED);
    }
}
