<?php

namespace App\Http\Controllers;

use App\Events\Users\UserRegistered;
use App\Models\Project;
use App\Models\ProjectStage;
use Exception;

class TestController extends Controller
{
    public function __construct(
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke()
    {

        $projectStage = ProjectStage::query()->create([
            'project_id' => 2,
            'stage_id' => 6,
        ]);

        dump($projectStage);

        $this->print_mem();
    }

    public function print_mem(): void
    {

        $project = Project::factory()->createOne();

        event(new UserRegistered($project));

        /* Currently used memory */
        $mem_usage = memory_get_usage();

        /* Peak memory usage */
        $mem_peak = memory_get_peak_usage();
        echo 'The script is now using: <strong>' . round($mem_usage / 1024) . 'KB</strong> of memory.<br>';
        echo 'Peak usage: <strong>' . round($mem_peak / 1024) . 'KB</strong> of memory.<br><br>';
    }
}
