<?php

namespace App\Listeners\Projects;

use App\Events\Projects\ProjectCreated;
use App\Mail\Projects\ProjectCreatedAdminEmail;
use App\Mail\Projects\ProjectCreatedUserEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class ProjectCreatedEmailNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(ProjectCreated $event): void
    {

        $user = $event->project->user;

        try {
            Mail::to($user->email)->send(
                new ProjectCreatedUserEmail(
                    $event->project,
                    $user
                )
            );

            Mail::to(env('EMAIL_ADMIN'))->send(
                new ProjectCreatedAdminEmail(
                    $event->project,
                    $user
                )
            );

        } catch (\Throwable $exception) {
            logger()->error($exception->getMessage(), [
                'trace' => $exception->getTrace(),
            ]);
        }

    }
}
