<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LNU QualiTeach | Faculty Evaluation System</title>
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
            LEYTE NORMAL UNIVERSITY QUALITEACH
        </div>
        <div class="user-info">
            <a href="{{ route('student.dashboard') }}" class="btn btn-link text-white text-decoration-none">
                <i class="fas fa-home me-1"></i> Dashboard
            </a>
            <a href="#" class="btn btn-link text-white text-decoration-none">
                <i class="fas fa-chart-bar me-1"></i> Reports
            </a>

            @php
                // Get the current student's data regardless of page context
                $currentStudent = \App\Models\Student::where('user_id', Auth::id())->first();
                $userName = $userName ?? ($currentStudent ? "{$currentStudent->first_name} {$currentStudent->last_name}" : 'Guest');
                
                // If no instructorsToEvaluate has been passed, let's get them
                if (!isset($instructorsToEvaluate) || empty($instructorsToEvaluate)) {
                    $studentEnrollments = $currentStudent ? $currentStudent->enrollments()->with('course.teacher')->get() : collect([]);
                    $instructorsToEvaluate = [];
                    
                    foreach ($studentEnrollments as $enrollment) {
                        if (!$enrollment->hasEvaluation()) {
                            $course = $enrollment->course;
                            $teacher = $course->teacher;
                            
                            $instructorsToEvaluate[$teacher->teacher_id] = [
                                'id' => $teacher->teacher_id,
                                'title' => $teacher->title,
                                'name' => "{$teacher->first_name} {$teacher->last_name}",
                                'subject' => $course->course_name,
                                'course_code' => $course->course_code,
                                'semester' => $course->semester,
                                'year' => $course->year,
                                'completed' => false,
                            ];
                        }
                    }
                }
                
                // Ensure a valid instructor ID is passed before generating the route
                $defaultInstructorId = isset($instructorData) ? $instructorData['id'] : 
                                    (isset($instructorsToEvaluate) && !empty($instructorsToEvaluate) ? array_key_first($instructorsToEvaluate) : null);
            @endphp

            @if(isset($defaultInstructorId))
                <a href="{{ route('feedback.create', ['instructor' => $defaultInstructorId]) }}" class="btn btn-evaluate">
                    <i class="fas fa-edit me-1"></i> Evaluate
                </a>
            @endif
            
            <!-- Dropdown for User Info -->
            <div class="dropdown">
                <div class="d-flex align-items-center text-white dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar bg-light text-primary me-2">
                        <i class="fas fa-user"></i>
                    </div>
                    <span>{{ $userName }}</span>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Static Sidebar Inside Layout) -->
            <div class="col-md-3 col-lg-2 sidebar">
                @php
                    // If essential variables don't exist, let's define them
                    if (!isset($instructors) || empty($instructors)) {
                        $studentEnrollments = $currentStudent ? $currentStudent->enrollments()->with('course.teacher')->get() : collect([]);
                        $instructors = [];
                        $completedInstructors = [];
                        
                        foreach ($studentEnrollments as $enrollment) {
                            $course = $enrollment->course;
                            $teacher = $course->teacher;
                            
                            $instructorInfo = [
                                'id' => $teacher->teacher_id,
                                'title' => $teacher->title,
                                'name' => "{$teacher->first_name} {$teacher->last_name}",
                                'subject' => $course->course_name,
                                'course_code' => $course->course_code,
                                'semester' => $course->semester,
                                'year' => $course->year,
                                'completed' => $enrollment->hasEvaluation(),
                            ];
                            
                            $instructors[$teacher->teacher_id] = $instructorInfo;
                            
                            if ($enrollment->hasEvaluation()) {
                                $completedInstructors[$teacher->teacher_id] = $instructorInfo;
                            }
                        }
                    }
                    
                    // Determine active instructor ID for highlighting
                    $activeInstructorId = $activeInstructorId ?? (isset($instructorData) ? $instructorData['id'] : null);
                    
                    // Colors for avatars
                    $colors = $colors ?? ['primary', 'success', 'danger', 'warning', 'info'];
                @endphp
                @include('student.sidebar', [
                    'activeInstructorId' => $activeInstructorId,
                    'instructors' => $instructors,
                    'completedInstructors' => $completedInstructors,
                    'instructorsToEvaluate' => $instructorsToEvaluate,
                    'colors' => $colors
                ])
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 content-area">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- Mobile Sidebar Toggle Button -->
    <button id="sidebarToggle" class="d-md-none">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript for sidebar toggle and tab functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768 && 
                    !sidebar.contains(event.target) && 
                    event.target !== sidebarToggle &&
                    !sidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            });

            // Initialize Bootstrap tabs
            const triggerTabList = document.querySelectorAll('#instructorTabs .nav-link');
            triggerTabList.forEach(function(triggerEl) {
                const tabTrigger = new bootstrap.Tab(triggerEl);
                
                triggerEl.addEventListener('click', function(event) {
                    event.preventDefault();
                    tabTrigger.show();
                });
            });

            // Set active tab based on URL or query parameter if needed
            // For example, if you have ?tab=completed in the URL
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab');
            
            if (activeTab) {
                const tabToActivate = document.querySelector(`#instructorTabs .nav-link[href="#${activeTab}"]`);
                if (tabToActivate) {
                    const tab = new bootstrap.Tab(tabToActivate);
                    tab.show();
                }
            }
        });
    </script>

    <!-- ini na section para an sidebar tabs, indicators para mga intructor-items -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile sidebar toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                event.target !== sidebarToggle &&
                !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });

        // Initialize Bootstrap tabs
        const triggerTabList = document.querySelectorAll('#instructorTabs .nav-link');
        triggerTabList.forEach(function(triggerEl) {
            const tabTrigger = new bootstrap.Tab(triggerEl);
            
            triggerEl.addEventListener('click', function(event) {
                event.preventDefault();
                tabTrigger.show();
            });
        });

        // Check if there are pending evaluations and highlight the tab
        const pendingCount = document.querySelector('#evaluate-tab .badge');
        if (pendingCount && parseInt(pendingCount.textContent) > 0) {
            document.getElementById('evaluate-tab').classList.add('text-danger');
            
            // Auto-select "To Evaluate" tab if there are pending evaluations and no specific tab is specified
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab');
            
            if (!activeTab) {
                const evaluateTab = document.getElementById('evaluate-tab');
                if (evaluateTab) {
                    const tab = new bootstrap.Tab(evaluateTab);
                    tab.show();
                }
            }
        }

        // Set active tab based on URL query parameter if present
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab');
        
        if (activeTab) {
            const tabToActivate = document.querySelector(`#instructorTabs .nav-link[href="#${activeTab}"]`);
            if (tabToActivate) {
                const tab = new bootstrap.Tab(tabToActivate);
                tab.show();
            }
        }
        
        // Add active class to sidebar instructor item when clicked
        const instructorItems = document.querySelectorAll('.instructor-item');
        instructorItems.forEach(item => {
            item.addEventListener('click', function() {
                instructorItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>

</body>
</html>