<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = User::create([
            'email' => 'test@mail.ru',
            'name' => 'Admin test',
            'nickname' => fake()->regexify('[a-z]{10}'),
            'password' => Hash::make('admin')
        ]);



//        Users::factory()
//            ->count(50)
//            ->create();
    }
}
