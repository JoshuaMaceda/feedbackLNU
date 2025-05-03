<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LNU Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/feedback-style.css') }}">
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo-section">
            <div class="bg-white p-1 rounded">LNU</div>
            <div class="logo-text">LNU Feedback</div>
        </div>
        <div class="user-actions">
            <button class="logout-btn">Logout</button>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <div class="sidenav">
        <div class="sidenav-header">Instructors</div>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('completed') ? 'active' : '' }}" href="{{ route('completed') }}">Completed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('to-evaluate') ? 'active' : '' }}" href="{{ route('to-evaluate') }}">To Evaluate</a>
            </li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="content-container">
        @if(!Request::is('instructor/*'))
            <div class="instructors-content">
                @include('student.instructor-list')
            </div>
        @endif
        
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add event listener to instructor items to handle selection
        document.addEventListener('DOMContentLoaded', function() {
            const instructorItems = document.querySelectorAll('.instructor-item');
            instructorItems.forEach(item => {
                item.addEventListener('click', function() {
                    const instructorId = this.getAttribute('data-instructor-id');
                    window.location.href = `/instructor/${instructorId}`;
                });
            });
        });
    </script>
</body>
</html>