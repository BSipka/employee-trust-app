<?php

namespace App\Http\Controllers;

use App\Events\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|exists:users'
        ]);

        $user = User::where('email', $data['email'])->first();
        event(new ResetPassword($user));

        return response(['message' => 'Password sent to your email'], 200);
    }
}
