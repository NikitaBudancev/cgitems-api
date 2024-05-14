<?php

namespace Database\Seeders\Project;

use App\Models\Media;
use App\Models\Project;
use App\Models\ProjectStage;
use Illuminate\Database\Seeder;

class ProjectStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectStage::factory()->count(150)->create();

        Project::chunk(50, function ($projects) {
            foreach ($projects as $project) {
                $projectStage = ProjectStage::where('project_id', $project->id)->first();

                if ($projectStage) {
                    $project->update([
                        'current_stage_id' => $projectStage->id
                    ]);
                }
            }
        });

        ProjectStage::chunk(100, function ($stages) {
            foreach ($stages as $stage) {
                // Создание превью
                $stage->media()->create([
                    'name' => random_int(1, 6) . '.jpg',
                    'type' => 'preview'
                ]);

                // Создание изображений
                for ($i = 0; $i <= 5; $i++) {
                    $stage->media()->create([
                        'name' => $i . '.jpg',
                        'type' => 'image'
                    ]);
                }
            }
        });
    }
}
