<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\CommonMarkConverter;

class PostController extends Controller
{

    public function index()
    {

        $posts = Post::simplePaginate(15);

        $converter = new CommonMarkConverter();

        $posts->getCollection()->transform(function ($post) use ($converter) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'category_id' => $post->category_id,
                'user_id' => $post->user_id,
                'content_html' => (string) $converter->convertToHtml($post->content),
                'content_plain' => strip_tags((string) $converter->convertToHtml($post->content)),

            ];
        });

        return Inertia::render('PostsPage', [
            'posts' => $posts,
            'categories' => Category::all(),
            'users' => User::all(),
        ]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $converter = new CommonMarkConverter();

        $post->content_html = (string) $converter->convertToHtml($post->content);


        return Inertia::render('SinglePost', [
            'post' => $post,
            'categories' => Category::all(),
            'users' => User::all(),
            'auth_user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request;

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id
        ]);

        return redirect('/');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts');
    }

}
