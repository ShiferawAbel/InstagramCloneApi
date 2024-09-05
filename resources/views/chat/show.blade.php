<x-chatLayout>
    <div class="messages-box">
        <div class="messages-header">
            <div class="message-profile-pic">
                <img src="{{ asset('storage/'.$chat_with->profile_url) }}" alt="">
            </div>
            <div class="message-to">
                {{ $chat_with->user_name }}
            </div>
        </div>

        <div class="texts-box">
            @foreach ($chat->messages as $message)
                @if ($message->user_id === auth()->user()->id)
                    <div class="mytext-box">
                        <div class="mytext">
                            <div class="reply-link-box">
                                <div class="reply-link" title="reply">
                                    <button class="reply-btn" onclick="replyToThis('{{ $message->message_body }}', {{$message->id}} )"><img src="{{asset('images/reply.png')}}" class="reply-link-icon" alt=""></button>
                                </div>
                            </div>
                            <div class="container-box">
                                <div class="chatbox">
                                    @if ($message->message_id)
                                        <div class="replied-to">
                                            <div class="replied-to-user">
                                                <p>{{$message->message->user->user_name}}</p> 
                                            </div>
                                            <div class="reply-message">
                                                <p>{{$message->message->message_body}}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="view-message">
                                        <p>{{ $message->message_body }} </p>
                                    </div>
                                    <div class="message-footer">
                                        
                                        <div class="time-sent">
                                            <p class="time-sent">{{ $message->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pointer">
                                </div>
                            </div>
                    
                            <div class="sender-identity">
                                <div class="chatbox-profile-box">
                                    <img class="chatbox-profile-image" src="{{ asset('storage/'.auth()->user()->profile_url) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    
                <div class="otherstext-box">
                     <div class="otherstext">
                         <div class="sender-identity">
                             <div class="chatbox-profile-box">
                                 <img class="chatbox-profile-image" src="{{ asset('storage/'.$chat_with->profile_url) }}" alt="">
                             </div>
                         </div>
                         <div class="container-box">
                             
                             <div class="pointer">
                                 
                             </div>
                             <div class="chatbox">
                                @if ($message->message_id)
                                    <div class="replied-to">
                                        <div class="replied-to-user">
                                            <p>{{ $message->message->user->user_name }}</p>
                                        </div>
                                        <div class="reply-message">
                                            <p>{{$message->message->message_body}}</p>
                                        </div>
                                    </div>
                                @endif
                                 <div class="view-message">
                                     <p> {{ $message->message_body }} </p>
                                 </div>
                                 <div class="message-footer">
                                     
                                     <div class="time-sent">
                                         <p class="time-sent">{{$message->created_at}}</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="reply-link-box">
                             <div class="reply-link" title="reply">
                                 <button class="reply-btn" onclick="replyToThis('{{ $message->message_body }}', {{$message->id}} )"><img src="{{asset('images/reply.png')}}" class="reply-link-icon" alt=""></button>
                             </div>
                         </div>
                     </div>
                 </div>
                @endif
            @endforeach
            

        </div>

        <div class="message-body">
            <div class="message-field-box">
                <div class="replying-to" id="replying-to">

                </div>
                <form action="/sendmessage" method="post">
                    @csrf
                    <input type="text" id="reply-to-field" name="reply_to" value="" hidden>
                    <input type="text" name="chat_id" value="{{$chat->id}}" hidden>
                    <input type="text" placeholder="Type Your Message Here"  name="message_body" class="message-field">
                    <button class="send-btn" type="submit">Send</button>
                </form>
            </div>
        </div>

    </div>
</x-chatLayout>