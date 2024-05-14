<?php

namespace App\Http\Controllers\Api\Users;

use App\Facades\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function index(): JsonResponse
    {
        $users = $this->userRepository->getAllWithPaginate(20);

        return ApiResponse::success(UserResource::collection($users))->respond();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return ApiResponse::success(new UserResource($user))->respond();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
