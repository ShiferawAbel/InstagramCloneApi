<x-layout>
    <div>
        <div class="profile-detail-box">
            <div class="profile-picture-show">
                <img class="profile-page-pic" src="{{asset('storage/'.$user->profile_url)}}" alt="">
            </div>
            <div class="account-desc">
                <div class="account-config">
                    {{ $user->user_name }}
                </div>
                <div class="account-social-status">
                    <div class="number-of-post">
                        <span class="desc-numb">1</span> Posts
                    </div>
                    <div class="followers">
                        <span class="desc-numb">{{$user->follower_number}}</span> followers
                    </div>
                    <div class="following">
                        <span class="desc-numb">{{$user->following_number}}</span> following
                    </div>
                </div>
                @if (auth()->user()->id === $user->id)
                <div class="message-edit">
                    <a href="/edit/{{ $user->id }}">Edit</a>
                </div>
                
                @else
                <div class="message-edit">
                    <a href="/startchat/{{ $user->id }}">Message</a>
                </div>
                    
                @endif
            </div>
        </div>
        <div class="all-user-posts">
            @if ($posts)
                @foreach ($posts as $post)
                    <a href="/post/{{$post->id}}">
                        <img src="{{ asset('storage/'.$post->file_url) }}" alt="hello">
                    </a>
                @endforeach
            
            @else
            <h1 style="margin-left: 10px; color:white;">No Posts Yet!</h1>
            @endif
        </div>
    </div>
</x-layout>
