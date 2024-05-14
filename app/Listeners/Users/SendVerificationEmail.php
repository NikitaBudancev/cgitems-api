<?php

namespace App\Listeners\Users;

use App\Events\Users\UserRegistered;
use App\Mail\Users\UserVerificationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
    ) {
    }

    public function handle(UserRegistered $event): void
    {

        try {
            Mail::to($event->user->email)->send(
                new UserVerificationEmail(
                    sprintf(
                        '%s/?code=%s',
                        config('mail.links.verification'),
                        $event->user->email_verification_token
                    )
                )
            );
        } catch (\Throwable $exception) {
            logger()->error($exception->getMessage(), [
                'trace' => $exception->getTrace(),
            ]);
        }
    }
}
