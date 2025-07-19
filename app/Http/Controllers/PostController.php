<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\CommonMark\CommonMarkConverter;

class PostController extends Controller
{

    public function index()
    {

        $posts = Post::orderBy('created_at', 'DESC')
            ->simplePaginate(9);

        $converter = new CommonMarkConverter();

        $posts->getCollection()->transform(function ($post) use ($converter) {

            $post->content_html = (string) $converter->convertToHtml($post->content);
            $post->content_plain = strip_tags($post->content_html);

            return $post;
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

        $viewedPosts = session('viewed_posts', []);

        if (!in_array($post->id, $viewedPosts)) {
            
            $viewedPosts[] = $post->id;
            session(['viewed_posts' => $viewedPosts]);

            $post->increment('views');
        }

        return Inertia::render('SinglePost', [
            'post' => $post,
            'categories' => Category::all(),
            'users' => User::all(),
            'auth_user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        //$attributes = $request;

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'views' => 0,
        ]);



        return redirect('/');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts');
    }
}
