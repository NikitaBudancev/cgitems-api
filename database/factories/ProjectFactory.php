<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\ProjectType;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Model>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->slug(),
            'name' => fake()->words(3, true),
            'project_description' => fake()->text(),
            'title' => fake()->title(),
            'keywords' => fake()->title(),
            'published' => fake()->boolean(true),
            'review' => fake()->paragraph(4),
            'review_date' => fake()->dateTime(),
            'course_id' => Course::inRandomOrder()->first()->id,
            'current_stage_id' => Stage::inRandomOrder()->first()->id,
            'project_type_id' => ProjectType::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
