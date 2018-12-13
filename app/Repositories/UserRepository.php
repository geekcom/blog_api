<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use Illuminate\Validation\Rule;

class UserRepository implements UserRepositoryContract
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($user_id)
    {
        $user = $this->findUserById($user_id);

        if ($user) {
            UserResource::withoutWrapping();
            return new UserResource($user);
        }
        return response()->json(['status' => 'error', 'message' => 'no data'], 404);
    }

    public function all()
    {
        $users = $this->user->paginate(10);

        return new UserCollection($users);
    }

    public function store($request)
    {
        $data = $request->all();
        $data['user_pass'] = Hash::make($data['user_pass']);

        $validator = Validator::make($data, [
            'user_login' => 'required',
            'user_pass' => 'required',
            'user_email' => 'required|unique:user',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => [
                    'user_login' => 'required',
                    'user_pass' => 'required',
                    'user_email' => 'required|unique',
                ]], 422);
        }

        $user = $this->user->create($data);

        UserResource::withoutWrapping();

        return new UserResource($user);
    }

    public function update($request, $user_id)
    {
        $user = $this->findUserById($user_id);

        if ($user) {

            $data = $request->all();

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $validator = Validator::make($data, [
                'user_login' => 'sometimes|required',
                'user_email' => [
                    'sometimes',
                    'required',
                    Rule::unique('user')->ignore($user_id, 'user_id'),
                ],
                'user_pass' => 'sometimes|required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => [
                        'user_login' => 'required',
                        'user_email' => 'required|unique_key',
                        'user_pass' => 'required',
                    ]], 422);
            }

            $user->update($data);

            UserResource::withoutWrapping();

            return new UserResource($user);
        }

        return response()->json(['status' => 'error', 'message' => 'no data'], 404);
    }

    public function delete($user_id)
    {
        $user = $this->findUserById($user_id);

        if ($user) {
            $user->delete();
            return response()->json(['status' => 'success', 'data' => null], 200);
        }
        return response()->json(['status' => 'error', 'message' => 'no data'], 404);
    }

    private function findUserById($user_id)
    {
        return $this->user
            ->where('user_id', $user_id)
            ->first();

    }
}