<?php

namespace Database\Seeders\User;

use App\Models\User;
use App\Models\UserColor;
use Illuminate\Database\Seeder;

class UserAvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::paginate(50);

        foreach ($users as $user) {
            $user->avatar()->create([
                'name' => 'avatar.png',
                'type' => 'avatar'
            ]);
        }
    }
}
