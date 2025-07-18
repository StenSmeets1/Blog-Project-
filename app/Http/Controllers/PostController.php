<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index() {
        
    }

    public function store(Request $request) {
        $attributes = $request;

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
            'category_id' => '1'
        ]);

        return redirect('/');
    }
}
