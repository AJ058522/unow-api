<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Repositories\Users\UsersRepository;

class UserController extends ApiController
{

    private $usersRepository;

    public function __construct(
        UsersRepository $usersRepository
    ) {
        $this->usersRepository = $usersRepository;
    }

    public function index()
    {
        $response = $this->usersRepository->index();
        return $this->showAll($response);
    }

    public function show(User $user)
    {
        $response = $this->usersRepository->show($user);
        return $this->showOne($response);
    }

    public function store(UserStoreRequest $request)
    {
        $response = $this->usersRepository->store( $request->validated() );
        return $this->successResponse($response, 201);
    }

    public function update($user, UserUpdateRequest $request)
    {
        $response = $this->usersRepository->update( $user, $request->validated() );
        return $this->successResponse($response, 200);
    }

    public function destroy(User $user)
    {
        $response = $this->usersRepository->destroy($user);
        return $this->successResponse($response, 200);
    }

}
