<?php

namespace App\Http\Controllers\Autentication;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Http\Requests\Autentication\LoginRequest;

class AutenticationController extends ApiController
{

  private function autenticate(LoginRequest $request)
  {
    $user = null;
    $credentials = request(['email', 'password']);

    if (Auth::attempt($credentials)) {
      $user = $request->user();
      $user->token = $user->createToken('Personal Access');
    }
    return $user;
  }

  public function login(LoginRequest $request)
  {
    $user = $this->autenticate($request);
    return ($user != null and $user->role_id != 5) ? $this->successResponse($user, 200) : $this->errorResponse('Usuario o Contraseña erróneo.', 404);
  }

  public function logout(Request $request)
  {
    $data = $request->user()->token()->revoke();
    return response()->json($data);
  }

}
