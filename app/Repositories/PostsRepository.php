<?php

namespace App\Repositories;

use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Repositories\Contracts\PostsRepositoryContract;
use Illuminate\Support\Facades\Validator;
use App\Models\Posts;

class PostsRepository implements PostsRepositoryContract
{
    protected $post;

    public function __construct(Posts $post)
    {
        $this->post = $post;
    }

    public function show($post_id)
    {
        $post = $this->findPostById($post_id);

        if ($post) {
            PostResource::withoutWrapping();
            return new PostResource($post);
        }
        return response()->json(['status' => 'error', 'message' => 'no data'], 404);
    }

    public function all()
    {
        $posts = $this->post->paginate(10);

        return new PostCollection($posts);
    }

    public function store($request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required',
            'post_author' => 'required',
            'post_date' => 'required',
            'post_content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => [
                    'user_id' => 'required',
                    'post_author' => 'required',
                    'post_date' => 'required',
                    'post_content' => 'required',
                ]], 422);
        }

        $post = $this->post->create($data);

        PostResource::withoutWrapping();

        return new PostResource($post);
    }

    public function update($request, $post_id)
    {
        $post = $this->findPostById($post_id);

        if ($post) {

            $data = $request->all();

            $validator = Validator::make($data, [
                'post_author' => 'required',
                'post_date' => 'required',
                'post_content' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => [
                        'post_author' => 'required',
                        'post_date' => 'required',
                        'post_content' => 'required',
                    ]], 422);
            }

            $post->update($data);

            PostResource::withoutWrapping();

            return new PostResource($post);
        }

        return response()->json(['status' => 'error', 'message' => 'no data'], 404);
    }

    public function delete($post_id)
    {
        $post = $this->findPostById($post_id);

        if ($post) {
            $post->delete();
            return response()->json(['status' => 'success', 'data' => null], 200);
        }
        return response()->json(['status' => 'error', 'message' => 'no data'], 404);
    }

    private function findPostById($post_id)
    {
        return $this->post
            ->where('post_id', $post_id)
            ->first();

    }
}