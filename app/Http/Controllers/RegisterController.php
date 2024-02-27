<?php

namespace App\Http\Controllers;

use App\Events\SendCodeConfirmation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;


class RegisterController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'remember_token' => Str::random(10),
        ]);

        $token = $user->createToken('access-token')->plainTextToken;


        event(new SendCodeConfirmation($user));

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }
}
