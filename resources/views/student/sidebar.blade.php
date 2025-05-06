@php
    // Ensure variables are defined to prevent errors
    $instructors = $instructors ?? [];
    $completedInstructors = $completedInstructors ?? [];
    $instructorsToEvaluate = $instructorsToEvaluate ?? [];
    $colors = $colors ?? ['primary', 'success', 'danger', 'warning', 'info'];
    $activeInstructorId = $activeInstructorId ?? null; // Get the active instructor ID
@endphp

<!-- Instructors Sidebar -->
<div class="sidebar-container">
    <h5 class="sidebar-heading">Instructors</h5>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs justify-content-around" id="instructorTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab">Completed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="evaluate-tab" data-bs-toggle="tab" href="#evaluate" role="tab">
                To Evaluate
                @if(count($instructorsToEvaluate) > 0)
                    <span class="badge bg-danger rounded-pill ms-1">{{ count($instructorsToEvaluate) }}</span>
                @endif
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3">
        <!-- All Instructors Tab -->
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            @if(count($instructors) > 0)
                @foreach($instructors as $instructor)
                    @php
                        // Convert to string for comparison to ensure type safety
                        $isActive = (string)$activeInstructorId === (string)$instructor['id'];
                        $isCompleted = isset($instructor['completed']) && $instructor['completed'];
                        // Determine badge color based on completion status
                        $badgeColor = $isCompleted ? 'success' : 'warning';
                        $badgeText = $isCompleted ? 'Evaluated' : 'Pending';
                    @endphp
                    <div class="instructor-item {{ $isActive ? 'active' : '' }}">
                        @if(isset($instructor['id']) && !$isCompleted)
                            <a href="{{ route('feedback.create', ['instructor' => $instructor['id']]) }}" class="text-decoration-none w-100 d-flex align-items-center">
                        @else
                            <div class="w-100 d-flex align-items-center">
                        @endif
                            <div class="instructor-avatar bg-{{ $colors[array_rand($colors)] }}">
                                {{ substr($instructor['name'] ?? '', 0, 1) }}
                            </div>
                            <div class="instructor-info flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="instructor-name">{{ $instructor['title'] ?? '' }} {{ $instructor['name'] ?? '' }}</div>
                                    <span class="badge bg-{{ $badgeColor }} small ms-1">{{ $badgeText }}</span>
                                </div>
                                <div class="small-text">Subject: {{ $instructor['subject'] ?? '' }}</div>
                                <div class="small-text">Course Code: {{ $instructor['course_code'] ?? '' }}</div>
                                <div class="small-text">Semester: {{ $instructor['semester'] ?? '' }}</div>
                                <div class="small-text">S.Y.: {{ $instructor['year'] ?? '' }}</div>
                            </div>
                        @if(isset($instructor['id']) && !$isCompleted)
                            </a>
                        @else
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="text-muted p-3">No instructors available.</p>
            @endif
        </div>

        <!-- Completed Evaluations Tab -->
        <div class="tab-pane fade" id="completed" role="tabpanel">
            @if(count($completedInstructors) > 0)
                @foreach($completedInstructors as $instructor)
                    @php
                        // Convert to string for comparison to ensure type safety
                        $isActive = (string)$activeInstructorId === (string)$instructor['id'];
                    @endphp
                    <div class="instructor-item {{ $isActive ? 'active' : '' }}">
                        <div class="d-flex align-items-center">
                            <div class="instructor-avatar bg-{{ $colors[array_rand($colors)] }}">
                                {{ substr($instructor['name'] ?? '', 0, 1) }}
                            </div>
                            <div class="instructor-info flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="instructor-name">{{ $instructor['title'] ?? '' }} {{ $instructor['name'] ?? '' }}</div>
                                    <span class="badge bg-success small ms-1">Evaluated</span>
                                </div>
                                <div class="small-text">Subject: {{ $instructor['subject'] ?? '' }}</div>
                                <div class="small-text">Course Code: {{ $instructor['course_code'] ?? '' }}</div>
                                <div class="small-text">Semester: {{ $instructor['semester'] ?? '' }}</div>
                                <div class="small-text">S.Y.: {{ $instructor['year'] ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted p-3">No completed evaluations yet.</p>
            @endif
        </div>

        <!-- To Evaluate Tab -->
        <div class="tab-pane fade" id="evaluate" role="tabpanel">
            @if(count($instructorsToEvaluate) > 0)
                @foreach($instructorsToEvaluate as $instructor)
                    @php
                        // Convert to string for comparison to ensure type safety
                        $isActive = (string)$activeInstructorId === (string)$instructor['id'];
                    @endphp
                    <div class="instructor-item {{ $isActive ? 'active' : '' }}">
                        @if(isset($instructor['id']))
                            <a href="{{ route('feedback.create', ['instructor' => $instructor['id']]) }}" class="text-decoration-none w-100 d-flex align-items-center">
                        @else
                            <div class="w-100 d-flex align-items-center">
                        @endif
                            <div class="instructor-avatar bg-warning">
                                {{ substr($instructor['name'] ?? '', 0, 1) }}
                            </div>
                            <div class="instructor-info flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="instructor-name">{{ $instructor['title'] ?? '' }} {{ $instructor['name'] ?? '' }}</div>
                                    <span class="badge bg-warning text-dark small ms-1">Pending</span>
                                </div>
                                <div class="small-text">Subject: {{ $instructor['subject'] ?? '' }}</div>
                                <div class="small-text">Course Code: {{ $instructor['course_code'] ?? '' }}</div>
                                <div class="small-text">Semester: {{ $instructor['semester'] ?? '' }}</div>
                                <div class="small-text">S.Y.: {{ $instructor['year'] ?? '' }}</div>
                            </div>
                        @if(isset($instructor['id']))
                            </a>
                        @else
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="text-muted p-3">No pending evaluations left! <i class="fas fa-check-circle text-success"></i></p>
            @endif
        </div>
    </div>
</div>