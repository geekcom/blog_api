<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AuthenticateRepositoryContract;
use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function authJWT(AuthenticateRepositoryContract $repository, Request $request)
    {
        return $repository->authJWT($request);
    }
}