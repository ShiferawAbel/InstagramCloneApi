<x-layout>
    <div class="find-friends-box">
        <h1>Find new friends to follow</h1>
        @foreach ($users as $user)
        <div class="user-box">
            <a href="/profile/{{ $user->id }}" class="to-profile">
                <div class="account-details">
                    <div class="profile-img-friend">
                        <img src="{{ asset('storage/'.$user->profile_url) }}" alt="">
                    </div>
                    <div class="name-status">
                        <div class="div">{{ $user->name }}</div>
                        <div class="status">1 post {{$user->follower_number}} followers {{$user->following_number}} following</div>
                    </div>
                </div> 
            </a>
            <div class="follow-btn">
                {{$following = false}}
                @foreach ($user->followers as $follower)
                <?php
                    if ($follower->id === auth()->user()->id) {
                        $following = true;
                    } else {
                        $following = false;
                    }
                    
                ?>
        
                @endforeach
                @if ($following)
                <a href="unfollow/{{$user->id}}">Following</a>
                
                @else
                <a href="follow/{{$user->id}}">Follow</a>
                
                @endif
            </div>
        </div>
        @endforeach
    </div>
</x-layout>