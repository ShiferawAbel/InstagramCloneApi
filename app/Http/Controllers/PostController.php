<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Post $post) {
        if (request()->comment) {
            $post_comments = Post::where('id', request()->comment)->first();
        } else {
            $post_comments = null;
        }

        
        return view('index', [
            'posts' => $post::latest()->get(),
            'post_comments' => $post_comments
        ]);
    }

    public function create() {
        return view('post.create');
    }
    public function store() {
        $form_data = request()->validate([
            'uploaded_by' => 'required',
            'caption' => 'required',
        ]);

        if(request()->hasfile('file_url')){
            $form_data['file_url'] = request()->file('file_url')->store('post', 'public');
        }

        $form_data['user_id'] = auth()->user()->id;

        Post::create($form_data);
        return redirect('/');
    } 
    
    public function show(Post $post) {
        return view('post.show', compact('post'));
    }
}
