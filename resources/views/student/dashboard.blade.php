@extends('student.layout')

@section('content')
    <div class="welcome-card">
        <h2>Welcome to QualiTeach: an LLM - Powered Teacher Evaluation Platform</h2>
        <p>Your voice matters! Help us improve teaching and learning by providing your valuable feedback on instructors.</p>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $totalInstructors ?? 0 }}</div>
                <div>Total Instructors</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $completedEvaluations ?? 0 }}</div>
                <div>Completed</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $pendingEvaluations ?? 0 }}</div>
                <div>Pending</div>
            </div>
        </div>
    </div>

    @if($pendingEvaluations > 0)
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-info-circle fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Ready to Evaluate ?</h5>
                        <p class="mb-0">Select an instructor from the sidebar to begin providing feedback.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">All Evaluations Completed</h5>
                        <p class="mb-0">Thank you for providing feedback on all your instructors!</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection