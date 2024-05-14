<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserColor;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserInfo>
 */
class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'avatar' => fake()->imageUrl(100, 100),
            'vk' => fake()->url(),
            'behance' => fake()->url(),
            'facebook' => fake()->url(),
            'artstation' => fake()->url(),
            'color_id' => UserColor::inRandomOrder()->first()->id,
            'user_id' => User::factory(),
        ];
    }
}
