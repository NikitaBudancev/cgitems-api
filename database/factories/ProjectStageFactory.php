<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Model>
 */
class ProjectStageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'stage_id' => Stage::inRandomOrder()->first()->id,
            'project_id' => Project::inRandomOrder()->first()->id,
        ];
    }
}
