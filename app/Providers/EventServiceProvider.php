<?php

namespace App\Providers;

use App\Events\Projects\ProjectCreated;
use App\Events\Users\UserRegistered;
use App\Listeners\Projects\ProjectCreatedEmailNotification;
use App\Listeners\Users\SendVerificationEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        UserRegistered::class => [
            SendVerificationEmail::class,
        ],
        ProjectCreated::class => [
            ProjectCreatedEmailNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
