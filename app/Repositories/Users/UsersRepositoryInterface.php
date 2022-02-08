<?php

namespace App\Repositories\Users;
use App\Models\User;

interface UsersRepositoryInterface
{
    public function index();

    public function store($data);

    public function show(User $user);

    public function update($user, $data);

    public function destroy(User $user);
}
