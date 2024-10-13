<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResource;
use App\Http\Resources\V1\PostCollection;
use App\Http\Resources\V1\CommentResource;

class ApiPostController extends Controller
{
    public function index(Request $request) {
        
        if($request['user']) {
            return new PostCollection(Post::orderBY('created_at', 'desc')->with('user.followers', 'liked_by')->get());
        }
        return (new PostCollection(Post::all()));
    }

    public function postComments (Post $post) {
        return CommentResource::collection($post->comments()->latest('created_at')->get());
    }

    public function store(PostRequest $request)
    {
        $request->validated();
        
        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->uploaded_by = auth()->user()->user_name;
        $post->caption = $request->caption;
        $post->file_url = $request->file('file_url')->store('posts', 'public');
        $post->save();

        return [
            'message' => 'Upload Successful',
            'post' => $post,
        ];
    }

    public function like_post(Request $request, Post $post)
    {
        $post->liked_by()->attach(auth()->user());

        return [
            'success'
        ];
    }
    
    public function remove_like(Request $request, Post $post)
    {
        $post->liked_by()->detach(auth()->user());

        return [
            'success'
        ];
    }

    public function show(Post $post)
    {
        // print($post->load('user'));
        return new PostResource($post->load('user'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return 'success';
    }
}
