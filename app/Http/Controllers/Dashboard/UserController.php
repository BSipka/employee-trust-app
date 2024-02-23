<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Facades\Redis;

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

        $this->redis->set('all_users', $users);

        return response($users, 200);
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
