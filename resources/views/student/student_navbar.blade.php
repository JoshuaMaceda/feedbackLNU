<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/student/dashboard.css') }}">
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar">
        <img src="{{ asset('images/lnu-logo.png') }}" alt="LNU Logo" class="logo">
        <h1>LEYTE NORMAL UNIVERSITY COURSE FEEDBACK</h1>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Evaluate</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Help</a></li>
        </ul>
        <!-- Profile & Logout Section -->
        <div class="profile-container">
            <span>{{ Auth::user()->name }}</span>
            <img src="{{ asset('images/profile.png') }}" alt="User Profile" class="profile-logo">
            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="content">
        @yield('content')
    </div>
</body>
</html>