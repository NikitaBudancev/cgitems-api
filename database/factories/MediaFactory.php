<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectStage;
use App\Models\MediaResource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StageMedia>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source' => fake()->imageUrl(),
            'resource_id' => MediaResource::inRandomOrder()->first()->id,
            'element_id' => Project::inRandomOrder()->first()->id,
            'type' => 'image'
        ];
    }
}
