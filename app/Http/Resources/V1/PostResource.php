<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'userId' => $this->user_id,
            'uploadedBy' => $this->uploaded_by,
            'caption' => $this->caption,
            'fileUrl' => 'http://127.0.0.1:8000/storage/' . $this->file_url,
            'user'=>new UserResource($this->whenLoaded('user'))
        ];
    }
}
