<?php

namespace App\Listeners;

use App\Events\SendCodeConfirmation;
use App\Notifications\CodeConfirmationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Redis\RedisManager;

class RegisterConfirmation
{
    /**
     * Create the event listener.
     */
    public function __construct(private RedisManager $redis)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(SendCodeConfirmation $event): void
    {

        $code = rand(100000, 999999);

        $this->redis->set(
            'verification_code_' .  $event->user->id,
            $code,
            'EX',
            32000
        );

        $event->user->notify(new CodeConfirmationEmail($code));
    }
}
