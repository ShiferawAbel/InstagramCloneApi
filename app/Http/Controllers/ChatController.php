<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index() {
        return view('chat.index');
    }

    public function startchat(User $user) {
        $chats_list = auth()->user()->chats;
        foreach ($chats_list as $chat) {
            $users = $chat->users->pluck('id')->toArray();
            if (in_array($user->id, $users)) {
                return redirect('/chat/'.$chat->id);
            }
        }
        return view('chat.startchat', compact('user'));
    }

    public function createchat(Request $request) {
        $user = User::where('id', $request->user_id)->get();
        if ($request['message_body'] !== '') {
            $chat = Chat::create(['type' => 'private']);
            $chat->users()->attach($user);
            $chat->users()->attach(auth()->user());

            $message = Message::create([
                'message_body' => $request['message_body'],
                'message_id' => $request['reply_to'],
                'chat_id' => $chat->id,
                'user_id' => auth()->user()->id,
            ]);
            return redirect('/chat/'.$chat->id);
        } else {
            return back();
        }

    }

    public function show(Chat $chat) {
        $chat_with = '';
        foreach ($chat->users as $user) {
            if ($user->id != auth()->user()->id) {
                $chat_with = $user;
            }
        }
// 
        if (in_array(auth()->user()->id, $chat->users->pluck('id')->toArray())) {
            return view('chat.show', compact('chat', 'chat_with'));
            
        } else {
            return response('what u doin nigga...this aint ur chat');
        }
        
    }

    public function sendmessage (Request $request) {
        if ($request['message_body'] !== '') {

            $message = Message::create([
                'message_body' => $request['message_body'],
                'message_id' => $request['reply_to'],
                'chat_id' => $request['chat_id'],
                'user_id' => auth()->user()->id,
            ]);
            return redirect('/chat/'.$request['chat_id']);
        } else {
            return back();
        }
    }
}
