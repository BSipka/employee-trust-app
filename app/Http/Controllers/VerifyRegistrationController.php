<?php

namespace App\Http\Controllers;

use App\Events\SendCodeConfirmation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Facades\Redis;

class VerifyRegistrationController extends Controller
{
    public function __construct(private RedisManager $redis)
    {
    }
    /**
     * Handle the incoming request.
     */
    public function verify(Request $request)
    {
        $code = $this->redis->get('verification_code_' . $request->user()->id);

        if (!$request->user()->hasVerifiedEmail() && $code === $request->verification_code) {
            $this->redis->del('verification_code_' . $request->user()->id);
            $request->user()->markEmailAsVerified();
            return response(['message' => 'User verified.'], 200);
        }



        return response(['message' => 'Verification failed'], 404);
    }

    public function resend(Request $request)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            event(new SendCodeConfirmation($request->user()));
            return response(['message' => 'Code sent.'], 200);
        }

        return response(['message' => 'Code resend failed'], 404);
    }
}
