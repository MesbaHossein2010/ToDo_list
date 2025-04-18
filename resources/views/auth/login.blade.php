<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="auth-body">
<div class="form-container">
    <h2>Login</h2>
    <form autocomplete="off" action="/login" method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
    </form>
    <div class="form-footer">
        <p>Don't have an account? <a href="/auth/register">Register</a></p>
    </div>
</div>
</body>
</html>
