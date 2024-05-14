<?php

namespace Database\Seeders\User;

use App\Models\UserInfo;
use Illuminate\Database\Seeder;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserInfo::factory()
            ->count(250)
            ->create();
    }
}
