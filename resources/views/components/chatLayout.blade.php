<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
    <script src="{{asset('js/script.js')}}" defer></script>
    <title>Document</title>
</head>
<body>
    <div class="chat-container">
        <x-sideNav />
        <div class="chats-list-box">
            <div class="chats-list-header">
                My Chats
            </div>
            @foreach (auth()->user()->chats as $chat)
                @foreach ($chat->users as $choose_other)
                    @if ($choose_other->id !== auth()->user()->id)
                        
                    <a href="/chat/{{$chat->id}}" class="chat-link">
                        <div class="chat-box">
                            <div class="chat-profile-pic">
                                <img src="{{ asset('storage/'.$choose_other->profile_url) }}" alt="">
                            </div>
                            <div class="chat-desc">
                                <div class="chat-with">
                                    {{ $choose_other->user_name }}
                                </div>
                                <div class="last-chat">
                                    @if (auth()->user()->id === $chat->messages->last()->user->id)
                                        <p> You:  {{strlen($chat->messages->last()->message_body) > 20 ? substr($chat->messages->last()->message_body, 0, 20) . "..." : $chat->messages->last()->message_body}}</p>
                                        
                                    @else
                                    <p> {{ $chat->messages->last()->user->user_name }}:  {{strlen($chat->messages->last()->message_body) > 20 ? substr($chat->messages->last()->message_body, 0, 20) . "..." : $chat->messages->last()->message_body}}</p>
                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif
                    
                @endforeach
            @endforeach
        </div>

        {{ $slot }}

    </div>
</body>
</html>