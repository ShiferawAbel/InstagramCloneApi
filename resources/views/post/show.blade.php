<x-layOut>
    <div class="post-detail-box">
        <div class="post-file">
            <img src="{{ asset('storage/'.$post->file_url) }}" alt="">
        </div>

        <div class="post-detail">
            <div class="posted-by">
            </div>
            
            <div class="comment-section-box">
                <div class="comment-section-header">
                    <div class="posted-by">
                        <div class="poster-profile">
                            <img src="{{ asset('storage/'.$post->user->profile_url) }}" alt="">
                        </div>
                        <div class="poster-username">
                            {{ $post->user->user_name }}

                        </div>
                    </div>

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
            </div>
        </div>
    </div>
</x-layOut>