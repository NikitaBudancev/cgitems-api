<?php

namespace Database\Seeders\Project;

use App\Models\Stage;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stage::create([
            'name' => 'Draft',
            'count' => '1 этап',
        ]);

        Stage::create([
            'name' => 'Highpoly / HP',
            'count' => '2 этап',
        ]);

        Stage::create([
            'name' => 'Lowpoly / LP',
            'count' => '3 этап',
        ]);

        Stage::create([
            'name' => 'Bake',
            'count' => '4 этап',
        ]);

        Stage::create([
            'name' => 'Render',
            'count' => '5 этап',
        ]);

        Stage::create([
            'name' => 'Sketchfab',
            'count' => '3D Viewer',
        ]);
    }
}
