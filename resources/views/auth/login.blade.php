<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="auth-body">
@csrf
<div class="form-container">
    <h2>Login</h2>
    <form action="{{ route('auth.login') }}" method="POST" autocomplete="off">
        @csrf
        <input type="text" name="username" placeholder="Username" required/>
        <input type="password" name="password" placeholder="Password" required/>
        <button type="submit">Login</button>
    </form>
    <div class="form-footer">
        <p>Don't have an account? <a href="/register">Register</a></p>
        <a href="/" class="back-home">← Back to Home</a>
    </div>
</div>
</body>
</html>
