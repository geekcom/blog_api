<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryContract;

class UserController extends Controller
{
    public function show(UserRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->show($id);
    }

    public function all(UserRepositoryContract $repositoryContract)
    {
        return $repositoryContract->all();
    }

    public function store(UserRepositoryContract $repositoryContract, Request $request)
    {
        return $repositoryContract->store($request);
    }

    public function update(UserRepositoryContract $repositoryContract, Request $request, $id)
    {
        return $repositoryContract->update($request, $id);
    }

    public function delete(UserRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->delete($id);
    }
}