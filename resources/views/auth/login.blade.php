<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}"> 
    <style>
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
            color: #666;
        }
    </style>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p class="error-message">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        Show
                    </button>
                </div>
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

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.querySelector('.toggle-password');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = 'Show';
        }
    }
</script>

</body>
</html>