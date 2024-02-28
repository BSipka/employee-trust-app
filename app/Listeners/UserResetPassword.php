<?php

namespace App\Listeners;

use App\Notifications\ResetPasswordEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class UserResetPassword
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $rndPass = Str::random(12);
        $event->user->update([
            'password' => $rndPass
        ]);

        $event->user->notify(new ResetPasswordEmail($rndPass));
    }
}
