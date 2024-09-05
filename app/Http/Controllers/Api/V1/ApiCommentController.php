<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\V1\CommentResource;

class ApiCommentController extends Controller
{
    public function store(CommentStoreRequest $request, Post $post) {

        $comment = new Comment();
        $comment->comment_body = $request['commentBody'];
        $comment->post_id = $post->id;
        $comment->user_id = auth()->user()->id;
        
        $comment->save();
        return new CommentResource($comment);
    }
}
