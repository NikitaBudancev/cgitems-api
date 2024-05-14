<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;


class MediaAvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::paginate(10);

        $imageUrl = fake()->imageUrl(300, 300, null, false);

        foreach ($users as $user) {
            $user->addMediaFromUrl($imageUrl)->toMediaCollection('avatars', 's3-avatar');
        }

    }
}
