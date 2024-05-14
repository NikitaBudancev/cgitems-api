<?php

namespace App\Providers;

use App\Contracts\Repositories\ProjectRepositoryContract;
use App\Contracts\Repositories\ProjectStageRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectStageRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryContract::class, UserRepository::class);
        $this->app->singleton(ProjectRepositoryContract::class, ProjectRepository::class);
        $this->app->singleton(ProjectStageRepositoryContract::class, ProjectStageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
