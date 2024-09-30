<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ChatResource;

class ApiChatController extends Controller
{
    public function index(Request $request)
    {
        $chats = $request->user()->chats()->with('users', 'messages')->orderBy('updated_at', 'desc')->get();
        return ChatResource::collection($chats);
    }

    public function store(Request $request) {
        // print($request->input('with_user'));
        $chat = Chat::create(['type' => 'private']);
        $chat->users()->attach(auth()->user());
        $chat->users()->attach($request->input('with_user'));
        return [
            'data' => $chat->id
        ];
    } 
    
    public function show($id, Request $request)
    {   
        $chatWithMessages = Chat::find($id)->load('messages');
        return new ChatResource($chatWithMessages);
        // if () {
        //     # code...
        // }
        // $chatWithMessages = $chat->load('messages');
    }
 
}
