<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'commentBody' => $this->comment_body,
            'createdAt' => $this->created_at,
            'post' => new PostResource($this->post),
            'user' => new UserResource($this->user)
        ];
    }
}
