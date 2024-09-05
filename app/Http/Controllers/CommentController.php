<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {
        $form_data = $request->validate([
            'comment_body' => 'required',
            'user_id' => 'required',
            'post_id' => 'required'
        ]);

        Comment::create($form_data);
        return back();
    }
}
