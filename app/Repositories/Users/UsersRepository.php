<?php

namespace App\Repositories\Users;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Models\User;

class UsersRepository implements UsersRepositoryInterface
{

    public function index()
    {
        return User::all();
    }

    public function store($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = new User($data);
        $user->save();
        return $user;
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update($user, $data)
    {
        $response = User::find($user)->update($data);
        return $response;
    }

    public function destroy($user)
    {
        return $user->delete();
    }
}
