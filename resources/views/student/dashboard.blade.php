@extends('layout')

@section('sidebar')
    <h5 class="sidebar-heading">Instructors</h5>
    
    <ul class="nav nav-tabs mb-3" id="instructorTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab">Completed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="evaluate-tab" data-bs-toggle="tab" href="#evaluate" role="tab">To Evaluate</a>
        </li>
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            <!-- When you implement dynamic data, use this loop: -->
            @foreach ($instructors as $instructor)
                <div class="instructor-item d-flex align-items-center">
                    <div class="instructor-avatar bg-{{ $colors[array_rand($colors)] }}">
                        {{ substr($instructor['name'], 0, 1) }}
                    </div>
                    <div class="instructor-info">
                        <div class="instructor-name">{{ $instructor['title'] }} {{ $instructor['name'] }}</div>
                        <div>Subject: {{ $instructor['subject'] }}</div>
                        <div>Course: {{ $instructor['course_code'] }}</div>
                        <div>Semester: {{ $instructor['semester'] }}</div>
                        <div>Year: {{ $instructor['year'] }}</div>
                    </div>
                </div>
            @endforeach

        </div>
        
        <div class="tab-pane fade" id="completed" role="tabpanel">
            @if(count($completedInstructors) > 0)
                @foreach ($completedInstructors as $instructor)
                    <div class="instructor-item d-flex align-items-center">
                        <div class="instructor-avatar bg-{{ $colors[array_rand($colors)] }}">
                            {{ substr($instructor['name'], 0, 1) }}
                        </div>
                        <div class="instructor-info">
                            <div class="instructor-name">{{ $instructor['title'] }} {{ $instructor['name'] }}</div>
                            <div>Subject: {{ $instructor['subject'] }}</div>
                            <div>Course: {{ $instructor['course_code'] }}</div>
                            <div>Semester: {{ $instructor['semester'] }}</div>
                            <div>Year: {{ $instructor['year'] }}</div>
                        </div>
                    </div>
                @endforeach
            @else
            <p class="text-muted p-3">No completed evaluations yet.</p>
            @endif
        </div>
        
        <div class="tab-pane fade" id="evaluate" role="tabpanel">
            @if(count($instructorsToEvaluate) > 0)
                @foreach ($instructorsToEvaluate as $instructor)
                    <div class="instructor-item d-flex align-items-center">
                        <div class="instructor-avatar bg-{{ $colors[array_rand($colors)] }}">
                            {{ substr($instructor['name'], 0, 1) }}
                        </div>
                        <div class="instructor-info">
                            <div class="instructor-name">{{ $instructor['title'] }} {{ $instructor['name'] }}</div>
                            <div>Subject: {{ $instructor['subject'] }}</div>
                            <div>Course: {{ $instructor['course_code'] }}</div>
                            <div>Semester: {{ $instructor['semester'] }}</div>
                            <div>Year: {{ $instructor['year'] }}</div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted p-3">No pending evaluations left!</p>
            @endif
        </div>
    </div>
@endsection

@section('content')
    <div class="welcome-card">
        <h2>Welcome to Course Feedback</h2>
        <p>Your voice matters! Help us improve teaching and learning by providing your valuable feedback on your instructors and courses.</p>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $totalInstructors }}</div>
                <div>Total Instructors</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $completedEvaluations }}</div>
                <div>Completed</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $pendingEvaluations }}</div>
                <div>Pending</div>
            </div>
        </div>
    </div>

    
    <div class="mt-4">
        <p>Select an instructor from the sidebar to begin providing feedback.</p>
    </div>
    
    {{-- When implementing dynamic data, you can show stats like this:
    <div class="row">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $totalInstructors }}</div>
                <div>Total Instructors</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $completedEvaluations }}</div>
                <div>Completed</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $pendingEvaluations }}</div>
                <div>Pending</div>
            </div>
        </div>
    </div>
    --}}
@endsection