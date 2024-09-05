<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
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
            return new PostCollection(Post::orderBY('created_at', 'desc')->with('user')->get());
        }
        return (new PostCollection(Post::all()));
        // return 'hi';
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
}
