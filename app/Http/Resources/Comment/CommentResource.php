<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'type' => 'comments',
            'id' => (string) $this->comment_id,
            'attributes' => [
                'comment_author' => $this->comment_author,
                'comment_author_email' => $this->comment_author_email,
                'comment_date' => $this->comment_date,
                'comment_content' => $this->comment_content,
            ],
            'links' => [
                'self' => route('comments') . DIRECTORY_SEPARATOR . $this->comment_id
            ]
        ];
    }
}
