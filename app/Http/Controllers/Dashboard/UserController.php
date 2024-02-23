<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Redis\RedisManager;

class UserController extends Controller
{
    public function __construct(private RedisManager $redis)
    {
    }
    public function index()
    {
        $cachedUsers = $this->redis->get('all_users');

        if (isset($cachedUsers)) {
            $data = json_decode($cachedUsers);
            return response($data, 200);
        }

        $users = User::all();

        $this->redis->set('all_users', $users, null, 60);

        return response($users, 200);
    }

    public function create(CreateRequest $request)
    {
        User::create($request->validated());

        return response(['message' => 'User created.'], 201);
    }

    public function update(UpdateRequest $request, User $user)
    {

        $user->update($request->validated());

        return response(['message' => 'User updated'], 200);
    }
}
