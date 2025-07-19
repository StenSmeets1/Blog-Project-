<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\CommonMarkConverter;


Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        $posts = Post::inRandomOrder()->take(3)->get();

        $converter = new CommonMarkConverter();

        $posts->transform(function ($post) use ($converter) {
            $post->content_html = (string) $converter->convertToHtml($post->content);
            $post->content_plain = strip_tags($post->content_html);
            return $post;
        });

        return Inertia::render('Home', [
            'posts' => $posts,
            'categories' => Category::all(),
            'users' => User::all(),
        ]);
    });

    Route::get('/posts', [PostController::class, 'index']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);

    Route::get('/posts/{slug}', [PostController::class, 'show']);

    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
    Route::post('/logout', [SessionController::class, 'destroy']);

    Route::post('/create', [PostController::class, 'store']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        });
        Route::get('/create', function () {
            return Inertia::render('CreatePost', [
                'categories' => Category::all(),
            ]);
        });
    });
});
