<?php

namespace Database\Seeders\Course;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Course::create([
            'name' => 'Gas Station',
            'price' => 42000,
            'color' => '#f0f0f0',
            'type' => 'easy',
            'link' => '/',
            'date_start' => fake()->dateTime(),
            'date_end' => fake()->dateTime(),
        ]);

        Course::create([
            'name' => 'Gas Station',
            'price' => 42000,
            'color' => '#f0f0f0',
            'type' => 'easy',
            'link' => '/',
            'date_start' => fake()->dateTime(),
            'date_end' => fake()->dateTime(),
        ]);

        Course::create([
            'name' => 'Gas Station',
            'price' => 42000,
            'color' => '#f0f0f0',
            'type' => 'easy',
            'link' => '/',
            'date_start' => fake()->dateTime(),
            'date_end' => fake()->dateTime(),
        ]);

    }
}
