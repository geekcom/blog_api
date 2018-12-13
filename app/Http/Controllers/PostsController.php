<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PostsRepositoryContract;

class PostsController extends Controller
{
    public function show(PostsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->show($id);
    }

    public function all(PostsRepositoryContract $repositoryContract)
    {
        return $repositoryContract->all();
    }

    public function store(PostsRepositoryContract $repositoryContract, Request $request)
    {
        return $repositoryContract->store($request);
    }

    public function update(PostsRepositoryContract $repositoryContract, Request $request, $id)
    {
        return $repositoryContract->update($request, $id);
    }

    public function delete(PostsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->delete($id);
    }
}
