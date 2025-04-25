<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/student/dashboard.css') }}">
</head>
<body>
    @extends('student.student_navbar')

    @section('title', 'Student Dashboard')

    @section('content')
        <!-- Sidebar (Instructor List) -->
        @if(isset($instructors) && count($instructors) > 0)
        <aside class="instructor-sidebar">
            <h2>Instructors</h2>
            @foreach ($instructors as $instructor)
            <div class="instructor-card">
                <img src="{{ asset('images/' . $instructor->image) }}" alt="Instructor Photo">
                <p><strong>{{ $instructor->name }}</strong></p>
                <p>Course: {{ $instructor->course }}</p>
                <p>Course Code: {{ $instructor->course_code }}</p>
                <p>Semester: {{ $instructor->semester }}</p>
            </div>
            @endforeach
        </aside>
        @else
        <p>No instructor data available.</p>
        @endif

        <!-- Main Section -->
        <main class="main-content">
            <img src="{{ asset('images/lnu-campus.jpg') }}" alt="University Background" class="background-image">
            <div class="speech-bubble">
                <p>Your voice matters! Help us improve teaching and learning by providing your valuable feedback.</p>
            </div>
        </main>
    @endsection
</body>
</html>