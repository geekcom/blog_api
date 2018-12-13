<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CommentsRepositoryContract;

class CommentsController extends Controller
{
    public function show(CommentsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->show($id);
    }

    public function all(CommentsRepositoryContract $repositoryContract)
    {
        return $repositoryContract->all();
    }

    public function store(CommentsRepositoryContract $repositoryContract, Request $request)
    {
        return $repositoryContract->store($request);
    }

    public function update(CommentsRepositoryContract $repositoryContract, Request $request, $id)
    {
        return $repositoryContract->update($request, $id);
    }

    public function delete(CommentsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->delete($id);
    }
}
