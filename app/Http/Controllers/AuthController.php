<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad Credentials'
            ], 401);
        }


        $token = $user->createToken('access-token')->plainTextToken;
        $response = [
            'full_name' => $user->fullName(),
            'role' => $user->role,
            'is_verified' => $user->hasVerifiedEmail(),
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(200);
    }
}
