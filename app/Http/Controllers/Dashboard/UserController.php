<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function create(Request $request, User $user)
    {
        // Todo: Validation
        $user->create($request->all());

        return response(['message' => 'User created.', 201]);
    }

    public function update(Request $request, User $user)
    {
        // Todo: Validation

        $user->update($request->all());

        return response(['message' => 'User updated'], 200);
    }
}
