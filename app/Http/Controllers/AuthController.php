<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();  // Security: regenerate session after login
            return redirect()->route('index');  // Redirect to the index page (dashboard, etc.)
        }

        return redirect()->route('auth.login')->withErrors([
            'username' => 'Invalid username or password',
        ]);
    }


    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Automatically log the user in after registration
        Auth::login($user);

        $request->session()->regenerate();  // Regenerate session for security

        return redirect()->route('index');
    }


    public function logout()
    {
        Auth::logout();
        session()->forget('token');
        session()->forget('user');
        return redirect()->route('index');
    }
}
