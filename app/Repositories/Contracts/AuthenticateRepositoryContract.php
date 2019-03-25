<?php

namespace App\Repositories\Contracts;

interface AuthenticateRepositoryContract
{
    public function authJWT($request);
}