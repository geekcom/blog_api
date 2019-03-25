<?php

namespace App\Repositories;

use App\Repositories\Contracts\AuthenticateRepositoryContract;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;
use App\Models\User;

final class AuthenticateRepository implements AuthenticateRepositoryContract
{
    private $jwt;
    private $user;

    public function __construct(JWTAuth $jwt, User $user)
    {
        $this->jwt = $jwt;
        $this->user = $user;
    }

    public function authJWT($request)
    {
        $data = $request->only('user_email', 'user_pass');

        $user = $this->user->where('user_email', $data['user_email'])->first();

        if ($user && Hash::check($data['user_pass'], $user->user_pass)) {
            $token = $this->jwt->fromUser($user);
            return response()->json(['status' => 'success', 'data' => ['token' => $token]], 200);
        }

        return response()->json([
            'status' => 'fail',
            'data' => ['email' => 'email is required', 'password' => 'password is required']
        ], 401);
    }
}