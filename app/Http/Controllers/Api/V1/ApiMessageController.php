<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;

class ApiMessageController extends Controller
{
    public function store(MessageRequest $request)
    {
        $message = Message::create($request->validated());
        $message->chat()->update(['new_message' => $message->chat->new_message + 1]);
        return [
            'message' => 'Message Successfully sent',
            'message' => $message
        ];
    }
}
