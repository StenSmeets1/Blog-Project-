<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        return Inertia::render('RegisterPage');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'unique:users'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', Password::min(8)->letters()->mixedCase()]
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => $attributes['password'],
            'isAdmin' => 0,
        ]);


        Auth::login($user);

        return redirect()->intended('/');
    }
}
