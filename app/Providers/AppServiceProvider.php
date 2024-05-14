<?php

namespace App\Providers;

use App\Models\Media;
use App\Models\Project;
use App\Models\ProjectStage;
use App\Observers\Projects\ProjectStageObserver;
use App\Policies\MediaPolicy;
use App\Policies\ProjectPolicy;
use App\Services\Api\ApiResponseService;
use App\Services\Api\Media\MediaManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $policies = [
        Project::class => ProjectPolicy::class,
        Media::class => MediaPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('ApiMediaManager', MediaManager::class);
        $this->app->bind('ApiResponse', ApiResponseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ProjectStage::observe(ProjectStageObserver::class);
    }
}
