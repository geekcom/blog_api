<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user'   => [
                'links' => [
                    'self'    => route('posts') . DIRECTORY_SEPARATOR . $this->post_id ,
                    'related' => route('users') . DIRECTORY_SEPARATOR  . $this->user_id,
                ],
                'data'  => new UserResource($this->user),
            ],
            'comments'   => [
                'links' => [
                    'self'    => route('comments') . DIRECTORY_SEPARATOR . $this->comment_id ,
                    'related' => route('users') . DIRECTORY_SEPARATOR  . $this->user_id,
                ],
                'data'  => new CommentResource($this->comment),
            ],
        ];
    }
    public function with($request)
    {
        return [
            'links' => [
                'self' => route('posts'),
            ],
        ];
    }
}
