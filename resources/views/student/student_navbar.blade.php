<!-- Simplified sticky top navigation bar for Laravel Blade -->
<header class="navbar">
    <div class="navbar-brand">
        <img src="{{ asset('images/lnu_logo.png') }}" alt="LNU Logo" class="navbar-logo">
        <span class="navbar-title">LNU Feedback</span>
    </div>
    <div class="navbar-right">
        <button class="navbar-icon">
            <i class="fas fa-bell"></i>
        </button>
        <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</header>   