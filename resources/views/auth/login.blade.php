<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}"> <!-- Updated path -->
</head>
<body>

<div class="login-container">
    <!-- Background Image -->
    <div class="background">
        <img src="{{ asset('images/lnu-campus.jpg') }}" alt="LNU Campus">
    </div>

    <!-- Login Form -->
    <div class="login-box">
        <img src="{{ asset('images/lnu-logo.png') }}" alt="LNU Logo" class="lnu-logo">
        <h2>EVALUATION SYSTEM</h2>
        <form action="{{ url('login') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="checkbox-container">
                <input type="checkbox" id="remember-me">
                <label for="remember-me">Remember me</label>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</div>


</body>
</html>
