<?php

namespace App\Repositories\Contracts;

interface UserRepositoryContract
{
    public function show($user_id);

    public function all();

    public function store($request);

    public function update($request, $user_id);

    public function delete($user_id);
}