<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/student/dashboard.css') }}">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <img src="{{ asset('images/lnu-logo.png') }}" alt="LNU Logo" class="logo">
        <h1>LEYTE NORMAL UNIVERSITY PEER FEEDBACK</h1>
        
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

    <!-- Sidebar (Instructor List) -->
    <!-- Instructor Sidebar -->
    @if(isset($peers) && count($peers) > 0)
    <aside class="instructor-sidebar">
        <h2>Instructors</h2>
        @foreach ($peers as $peer)
        <div class="instructor-card">
            <img src="{{ asset('images/' . $instructor->image) }}" alt="Peer Photo">
            <p><strong>{{ $instructor->name }}</strong></p>
            <p>Course: {{ $instructor->course }}</p>
            <p>Course Code: {{ $instructor->course_code }}</p>
            <p>Semester: {{ $instructor->semester }}</p>
        </div>
        @endforeach
    </aside>
    @else
    <p>No peer data available.</p>
    @endif


    <!-- Main Section -->
    <main class="main-content">
        <img src="{{ asset('images/lnu-campus.jpg') }}" alt="University Background" class="background-image">
        <div class="speech-bubble">
            <p>Your voice matters! Help us improve teaching and learning by providing your valuable feedback.</p>
        </div>
    </main>

</body>
</html>
