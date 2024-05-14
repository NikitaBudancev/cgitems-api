<?php

namespace Database\Seeders\Project;

use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectType::create([
            'name' => 'Личный проект',
            'description' => 'test',
        ]);

        ProjectType::create([
            'name' => 'Курсовой проект',
            'description' => 'test',
        ]);
    }
}
