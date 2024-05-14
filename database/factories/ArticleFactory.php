<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
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
            'name' => fake()->title(),
            'preview_img' => fake()->imageUrl(),
            'category_id' => ArticleCategory::factory(),
            'content' => fake()->text(),
            'title' => fake()->title(),
            'keywords' => fake()->title(),
            'description' => fake()->text(),
        ];
    }
}
