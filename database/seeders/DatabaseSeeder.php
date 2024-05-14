<?php

namespace Database\Seeders;

use Database\Seeders\Article\ArticleCategorySeeder;
use Database\Seeders\Article\ArticleSeeder;
use Database\Seeders\Course\CourseSeeder;
use Database\Seeders\Project\ProjectSeeder;
use Database\Seeders\Project\ProjectStageSeeder;
use Database\Seeders\Project\ProjectTypeSeeder;
use Database\Seeders\Project\StageSeeder;
use Database\Seeders\User\UserAvatarSeeder;
use Database\Seeders\User\UserColorSeeder;
use Database\Seeders\User\UserInfoSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionsSeeder::class,
            UserColorSeeder::class,
            UserInfoSeeder::class,
            UserAvatarSeeder::class,
            CourseSeeder::class,
            ArticleCategorySeeder::class,
            ArticleSeeder::class,
            StageSeeder::class,
            ProjectTypeSeeder::class,
            ProjectSeeder::class,
            ProjectStageSeeder::class,


//            MediaAvatarSeeder::class,
        ]);
    }
}
