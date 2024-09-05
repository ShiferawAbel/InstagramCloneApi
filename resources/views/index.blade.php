<x-layout>
    <div class="feed">
        <div class="all-story">
            @foreach ($posts as $post)
            <div class="story">
                <div class="profile-picture-box">
                    <img class="profile-picture" src="{{ asset('storage/'.$post->file_url) }}" alt="">
                </div>
                <div class="story-username">
                    cominsoon
                </div>
            </div>
                
            @endforeach
            
        </div>
        <div class="all-posts">
            <div class="column-flex">
                @foreach ($posts as $post)
                <div class="post">
                    <div class="the-poster">
                        <div class="aboutpost">
                            <div class="poster-profile-box">
                                <img class="poster-profile-picture" src="{{ asset('storage/'.$post->user->profile_url) }}" alt="" class="poster-profile-pic">
                            </div>
                            <div class="poster-username">
                                {{$post->uploaded_by}}
                            </div>
                            <div class="posted-time">
                                - 3h
                            </div>
                        </div>
                        <div class="moreoptions">
                            {{ $following = false }}
                            @foreach ($post->user->followers as $follower)
                                <?php 
                                    if ($follower->id == auth()->user()->id){
                                        $following = true;
                                    }
                                ?>                                
                            @endforeach

                            @if ($following)
                                <a href="unfollow/{{ $post->user->id }}">UnFollow</a> 
                            @else
                                <a href="follow/{{ $post->user->id }}">Follow</a>
                            @endif
                        </div>
                    </div>
                    <div class="post-img-box">
                        <img src="{{ asset('storage/'.$post->file_url) }}" alt="" class="post-img">
                    </div>
                    <div class="activities">
                        <div class="rightactivities">
                            <img class="like-post" src="{{asset('images/notification.png')}}" alt="">
                        </div>
                        <div class="leftactivities">
                            <img class="save-post" src="image/notification.png" alt="">
                        </div>
                    </div>
                    <div class="liked-by">
                        Liked by <span  class="users-like"></span> antoniolosreyes and <span class="other-like">others</span> 
                    </div>
                    <div class="post-decription">
                        <div class="post-describer">
                            {{ $post->uploaded_by }}
                        </div>
                        <div class="description">
                            {{ $post->caption }}
                        </div>
                    </div>
                    <div class="comment-section">
                        @if ($post_comments)
                            
                            @if ($post->id === $post_comments->id)
                                <div class="comment-section-box">
                                    <div class="comment-section-header">
                                        <div>Post Comments</div>
                                        <div><a href="/">X</a></div>
                                        
                                    </div>
                                    <div class="comments-list">
                                        @foreach ($post->comments as $comment)
                                    
                                            <div class="user-comment-box">
                                                <div class="comment-profile-picture">
                                                    <img src="{{asset('storage/'.$comment->user->profile_url)}}" alt="">
                                                </div>
                                                <div class="name__comment">
                                                    <div class="commenter-user-name">
                                                        {{ $comment->user->user_name }}
                                                    </div>
                                                    <div class="comment-body">
                                                        {{ $comment->comment_body }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="post-comment">
                                        <form action="/comment" method="post">
                                            @csrf
                                            <input type="text" name="comment_body" class="comment-body" placeholder="Type your comment here" id="">
                                            <input type="text" name="post_id" value="{{$post->id}}" id="" hidden>
                                            <input type="text" name="user_id" value="{{auth()->user()->id}}" id="" hidden>
                                            <button type="submit" class="post-comment-btn">Post</button>

                                        </form>
                                    </div>
                                </div>
                            @else
                                <a href="/?comment={{$post->id}}">show comments</a>
                                
                            @endif
                        @else
                            <a href="/?comment={{$post->id}}">show comments</a>

                        @endif

                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
    <div class="right-side">
        <div class="account">
            <div class="about-account">
                <div class="account-profile">
                    <img src="../profile.jpg" alt="" class="account-profile-img">
                </div>
                <div class="user">
                    <div class="account-username">
                        Gech od
                    </div>
                    <div class="account-fullname">
                        Abel Shiferaw
                    </div>
                </div>
            </div>

            <div class="switch-follow">
                <a class="switch-link" href="">Switch</a>
            </div>
        </div>

        <div class="suggested-accounts-text">
            <div class="suggested-for-you">
                Suggested for you
            </div>
            <div class="see-all">
                See All
            </div>
        </div>
        <div class="account">
            <div class="about-account">
                <div class="account-profile">
                    <img src="../profile.jpg" alt="" class="account-profile-img">
                </div>
                <div class="user">
                    <div class="account-username">
                        Gech od
                    </div>
                    <div class="account-fullname">
                        Abel Shiferaw
                    </div>
                </div>
            </div>

            <div class="switch-follow">
                <a class="switch-link" href="">Switch</a>
            </div>
        </div>
        <div class="account">
            <div class="about-account">
                <div class="account-profile">
                    <img src="../profile.jpg" alt="" class="account-profile-img">
                </div>
                <div class="user">
                    <div class="account-username">
                        Gech od
                    </div>
                    <div class="account-fullname">
                        Abel Shiferaw
                    </div>
                </div>
            </div>

            <div class="switch-follow">
                <a class="switch-link" href="">Switch</a>
            </div>
        </div>
        <div class="account">
            <div class="about-account">
                <div class="account-profile">
                    <img src="../profile.jpg" alt="" class="account-profile-img">
                </div>
                <div class="user">
                    <div class="account-username">
                        Gech od
                    </div>
                    <div class="account-fullname">
                        Abel Shiferaw
                    </div>
                </div>
            </div>

            <div class="switch-follow">
                <a class="switch-link" href="">Switch</a>
            </div>
        </div>
        <div class="account">
            <div class="about-account">
                <div class="account-profile">
                    <img src="../profile.jpg" alt="" class="account-profile-img">
                </div>
                <div class="user">
                    <div class="account-username">
                        Gech od
                    </div>
                    <div class="account-fullname">
                        Abel Shiferaw
                    </div>
                </div>
            </div>

            <div class="switch-follow">
                <a class="switch-link" href="">Switch</a>
            </div>
        </div>
        <div class="account">
            <div class="about-account">
                <div class="account-profile">
                    <img src="../profile.jpg" alt="" class="account-profile-img">
                </div>
                <div class="user">
                    <div class="account-username">
                        Gech od
                    </div>
                    <div class="account-fullname">
                        Abel Shiferaw
                    </div>
                </div>
            </div>

            <div class="switch-follow">
                <a class="switch-link" href="">Switch</a>
            </div>

        </div>
        <p class="i-ran-out-of-words">About . Help . Press . API . Jobs . Privacy . Terms . Locations . Language . Meta Verified</p>
        <p class="i-ran-out-of-words-again">© 2023 INSTAGRAM FROM META</p>
    </div>
</x-layout>