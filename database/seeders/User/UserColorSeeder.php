<?php

namespace Database\Seeders\User;

use App\Models\UserColor;
use Illuminate\Database\Seeder;

class UserColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserColor::create([
            'name' => 'Оранжевый',
            'color' => '#E3AE00',
        ]);

        UserColor::create([
            'name' => 'Лаймовый',
            'color' => '#99CC33',
        ]);
    }
}
