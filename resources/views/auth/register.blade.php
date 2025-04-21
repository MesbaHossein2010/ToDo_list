<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="auth-body">
<div class="form-container">
    <h2>Register</h2>
    <form action="{{ route('auth.register') }}" method="POST" autocomplete="off">
        @csrf
        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required/>
        @error('username')
        <strong style="color: red;" >{{$message}}</strong>
        @enderror
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required/>
        @error('email')
        <strong style="color: red;" >{{$message}}</strong>
        @enderror
        <input type="password" name="password" placeholder="Password" value="{{ old('password') }}" required/>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required/>
        @error('password')
        <strong style="color: red;" >{{$message}}</strong>
        @enderror
        <button type="submit">Register</button>
    </form>
    <div class="form-footer">
        <p>Already have an account? <a href="/login">Login</a></p>
        <a href="/" class="back-home">← Back to Home</a>
    </div>
</div>
</body>
</html>
