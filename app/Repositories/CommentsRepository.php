<?php

namespace App\Repositories;

use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Post\PostCollection;
use App\Models\Comments;
use App\Repositories\Contracts\CommentsRepositoryContract;
use Illuminate\Support\Facades\Validator;

class CommentsRepository implements CommentsRepositoryContract
{
    protected $comment;

    public function __construct(Comments $comment)
    {
        $this->comment = $comment;
    }

    public function show($comment_id)
    {
        $comment = $this->findCommentById($comment_id);

        if ($comment) {
            CommentResource::withoutWrapping();
            return new CommentResource($comment);
        }
        return response()->json(['status' => 'error', 'message' => 'no data'], 404);
    }

    public function all()
    {
        $comments = $this->comment->paginate(10);

        return new PostCollection($comments);
    }

    public function store($request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'post_id' => 'required',
            'comment_author' => 'required',
            'comment_author_email' => 'required',
            'comment_date' => 'required',
            'comment_content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => [
                    'post_id' => 'required',
                    'comment_author' => 'required',
                    'comment_author_email' => 'required',
                    'comment_date' => 'required',
                    'comment_content' => 'required',
                ]], 422);
        }

        $comment = $this->comment->create($data);

        CommentResource::withoutWrapping();

        return new CommentResource($comment);
    }

    public function update($request, $comment_id)
    {
        $comment = $this->findCommentById($comment_id);

        if ($comment) {

            $data = $request->all();

            $validator = Validator::make($data, [
                'post_id' => 'required',
                'comment_author' => 'required',
                'comment_author_email' => 'required',
                'comment_date' => 'required',
                'comment_content' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'fail',
                    'data' => [
                        'post_id' => 'required',
                        'comment_author' => 'required',
                        'comment_author_email' => 'required',
                        'comment_date' => 'required',
                        'comment_content' => 'required',
                    ]], 422);
            }

            $comment->update($data);

            CommentResource::withoutWrapping();

            return new CommentResource($comment);
        }

        return response()->json(['status' => 'error', 'message' => 'no data'], 404);
    }

    public function delete($comment_id)
    {
        $comment = $this->findCommentById($comment_id);

        if ($comment) {
            $comment->delete();
            return response()->json(['status' => 'success', 'data' => null], 200);
        }
        return response()->json(['status' => 'error', 'message' => 'no data'], 404);
    }

    private function findCommentById($comment_id)
    {
        return $this->comment
            ->where('comment_id', $comment_id)
            ->first();
    }
}