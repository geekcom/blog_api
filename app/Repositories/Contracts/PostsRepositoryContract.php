<?php

namespace App\Repositories\Contracts;

interface PostsRepositoryContract
{
    public function show($post_id);

    public function all();

    public function store($request);

    public function update($request, $post_id);

    public function delete($user_id);
}