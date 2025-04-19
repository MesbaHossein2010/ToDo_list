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
            $user = Auth::user();
            $token = $user->createToken('webToken')->accessToken;

            session(['token' => $token]);

            return redirect()->route('index');
        }

        $error = 'Invalid username or password';
        return view('auth.login', compact('error'));
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::create([
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $token = $user->createToken('webToken')->accessToken;
        session(['token' => $token]);

        return redirect()->route('index');
    }

    public function logout()
    {
        session()->forget('token');
        return redirect()->route('index');
    }
}
