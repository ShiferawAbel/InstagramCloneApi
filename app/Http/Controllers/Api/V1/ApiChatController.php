<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ChatResource;

class ApiChatController extends Controller
{
    public function index(Request $request)
    {
        $chats = $request->user()->chats()->with('users', 'messages')->get();
        return ChatResource::collection($chats);
    }
}
