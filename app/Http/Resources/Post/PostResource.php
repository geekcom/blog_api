<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'type' => 'posts',
            'id' => (string) $this->post_id,
            'attributes' => [
                'post_author' => $this->post_author,
                'post_date' => $this->post_date,
                'post_title' => $this->post_title,
                'post_content' => $this->post_content,
            ],
            'relationships' => new PostRelationshipResource($this),
            'links' => [
                'self' => route('posts') . DIRECTORY_SEPARATOR . $this->post_id
            ]
        ];
    }
}
