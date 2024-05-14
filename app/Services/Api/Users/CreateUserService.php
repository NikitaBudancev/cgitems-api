<?php

namespace App\Services\Api\Users;

use App\DTO\Users\RegisterUserDto;
use App\Events\Users\UserRegistered;
use App\Models\User;
use App\Models\UserColor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Throwable;

class CreateUserService
{
    /**
     * @throws Throwable
     */
    public function __invoke(RegisterUserDto $userDto): User
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'first_name' => $userDto->firstName,
                'last_name' => $userDto->lastName,
                'email' => $userDto->email,
                'nickname' => $userDto->nickname,
                'password' => Hash::make($userDto->password),
                'email_verification_token' => Str::random(50),
            ]);

            $user->assignRole('user');

            $user->info()->create([
                'color_id' => UserColor::query()->inRandomOrder()->first()->id,
            ]);

            DB::commit();

            event(new UserRegistered($user));

            return $user;
        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
