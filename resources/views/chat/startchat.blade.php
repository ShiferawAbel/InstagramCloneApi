<x-chatLayout>
    <div class="messages-box">
        <div class="messages-header">
            <div class="message-profile-pic">
                <img src="{{ asset('storage/'.$user->profile_url) }}" alt="">
            </div>
            <div class="message-to">
                {{ $user->user_name }}
            </div>
        </div>
        <div class="message-body">
            <div class="message-field-box">
                <form action="/createchat" method="post">
                    @csrf
                    <input type="text" name="reply_to" value="" hidden>
                    <input type="text" name="user_id" value="{{$user->id}}" hidden>
                    <input type="text" placeholder="Type Your Message Here" name="message_body" class="message-field">
                    <button class="send-btn" type="submit">Send</button>
                </form>
            </div>
        </div>

    </div>
</x-chatLayout>
