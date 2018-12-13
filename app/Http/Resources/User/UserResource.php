<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'users',
            'id' => (string) $this->user_id,
            'attributes' => [
                'user_login' => $this->user_login,
                'user_email' => $this->user_email,
                'user_display_name' => $this->user_display_name,
            ],
            'links' => [
                'self' => route('users') . DIRECTORY_SEPARATOR . $this->user_id
            ]
        ];
    }
}
