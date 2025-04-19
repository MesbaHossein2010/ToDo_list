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
        <input type="text" name="username" placeholder="Username" required/>
        <input type="email" name="email" placeholder="Email" required/>
        <input type="password" name="password" placeholder="Password" required/>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required/>
        <button type="submit">Register</button>
    </form>
    <div class="form-footer">
        <p>Already have an account? <a href="/login">Login</a></p>
        <a href="/" class="back-home">← Back to Home</a>
    </div>
</div>
</body>
</html>
