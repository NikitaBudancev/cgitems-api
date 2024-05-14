<?php

namespace App\Services\Api\Users;

use App\Models\User;
use Illuminate\Support\Str;

class VerificationUserService
{
    public function verifyByEmailToken(string $token): void
    {
        $user = User::query()->where('email_verification_token', $token)->firstOrFail();

        $user->update([
            'email_verification_token' => Str::random(50),
            'email_verified_at' => now(),
        ]);
    }
}
