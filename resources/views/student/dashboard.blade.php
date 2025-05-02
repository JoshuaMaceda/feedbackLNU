@extends('layout')

@section('content')
<div class="instructor-detail-container">
    <div class="welcome-card">
        <h2>Welcome to Course Feedback</h2>
        <p>Your voice matters! Help us improve teaching and learning by providing your valuable feedback on your instructors and courses.</p>
    </div>

    <div class="stats-container">
        <div class="stats-card">
            <div class="stats-label">Total Instructors</div>
            <h2>6</h2>
        </div>
        
        <div class="stats-card">
            <div class="stats-label">Completed</div>
            <h2>0</h2>
        </div>
        
        <div class="stats-card">
            <div class="stats-label">Pending</div>
            <h2>6</h2>
        </div>
    </div>

    <div class="instruction-text">
        Select an instructor from the list to begin providing feedback.
    </div>
</div>
@endsection