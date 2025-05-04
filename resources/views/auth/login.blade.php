<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}"> 
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <div class="logo-container">
            <div class="logo">
                <img src="{{ asset('images/lnu_logo.jfif') }}" alt="Evaluation System Logo">
            </div>
            <h1>EVALUATION SYSTEM</h1>
            <p class="subtitle">Log in to access your account</p>
        </div>
        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="remember-me">
                <input type="checkbox" id="remember-me" name="remember">
                <label for="remember-me">Remember me</label>
            </div>
            <button type="submit" class="btn-login">Login</button>
            <div class="additional-links">
                <span>Forgot your password?</span>
                <a href="{{ url('password/reset') }}">Reset now</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>

<