<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LNU Feedback System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/feedback-style.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo-text">
            <img src="{{ asset('images/lnu-logo.png') }}" alt="LNU Logo" class="logo-img">
            LNU Feedback
        </div>
        <div class="user-info position-absolute end-0 d-flex align-items-center gap-5">
            <a href="{{ route('student.dashboard') }}" class="text-white text-decoration-none">Dashboard</a>

            <!-- Dropdown for User Info -->
            <div class="dropdown">
                <span class="dropdown-toggle text-white me-5" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $userName ?? auth()->user()->name }}
                </span>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                @yield('sidebar')
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 content-area">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
