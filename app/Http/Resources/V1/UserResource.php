<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'profileUrl' => 'http://127.0.0.1:8000/storage/' . $this->profile_url,
            'name' => $this->name,
            'email' => $this->email,
            'userName' => $this->user_name,
            'followerNumber' => $this->follower_number,
            'followingNumber' => $this->following_number,
            'posts' => PostResource::collection($this->whenLoaded('posts')),
            'followers' => UserResource::collection($this->whenLoaded('followers')),
            'following' => UserResource::collection($this->whenLoaded('following')),
            'note' => $this->whenLoaded('notes'),
        ];
    }
}
