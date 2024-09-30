<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'messageBody' => $this->message_body,
            'replyTo' => new MessageResource($this->message),
            'user' => new UserResource($this->user),
            'sentAt' => $this->created_at,
        ];
    }
}
