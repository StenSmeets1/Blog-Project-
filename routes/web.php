<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;



Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    });

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
        Route::get('/create', function() {
            return Inertia::render ('CreatePost');
        });
    });
});
