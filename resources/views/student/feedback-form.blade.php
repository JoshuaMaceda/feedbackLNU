@extends('student.layout')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <h2 class="qualiteach-title">Currently Evaluating:</h2>
        <div class="instructor-info-card">
            <h3 class="mb-2">{{ $instructorData['title'] ?? '' }} {{ $instructorData['name'] ?? '' }}</h3>
            <div class="row mb-2">
                <div class="col-md-6">
                    <p class="mb-1"><i class="fas fa-book me-2"></i> <strong>Subject:</strong> {{ $instructorData['subject'] ?? '' }}</p>
                    <p class="mb-1"><i class="fas fa-id-card me-2"></i> <strong>Course:</strong> {{ $instructorData['course_code'] ?? '' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><i class="fas fa-calendar me-2"></i> <strong>Semester:</strong> {{ $instructorData['semester'] ?? '' }}</p>
                    <p class="mb-1"><i class="fas fa-calendar-alt me-2"></i> <strong>Year:</strong> {{ $instructorData['year'] ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf

        <input type="hidden" name="teacher_id" value="{{ $instructorData['id'] ?? '' }}">
        <input type="hidden" name="course_id" value="{{ $instructorData['course_code'] ?? '' }}">

        @php
        $categories = [
            'professionalism' => [
                'Attends class regularly',
                'Comes to class on time',
                'Maximizes the use of class period',
                'Comes to class prepared with the lesson and instructional materials',
                'Dismisses class on time; not too early nor too late'
            ],
            'commitment' => [
                'Makes himself/herself available to students beyond official teaching hours',
                'Returns checked homework, quizzes, and test papers',
                'Enriches course content with current library and internet sources',
                'Willingly assists students with school-related concerns',
                'Demonstrates sensitivity to different kinds of learners'
            ],
            'knowledge' => [
                'Explains the subject matter without completely relying on prescribed readings',
                'Explains subject matter with depth',
                'Integrates topics with previously learned concepts',
                'Raises relevant problems and issues',
                'Shares information on new developments in their field'
            ],
            'independent_learning' => [
                'Uses strategies that allow students to practice concepts',
                'Provides exercises that develop analytical thinking',
                'Enhances students\' self-esteem through recognition of abilities',
                'Allows students to participate in developing course syllabi',
                'Encourages students to think independently'
            ],
            'management' => [
                'Maximizes opportunities for classroom participation',
                'Acts as facilitator, coach, or guide as needed',
                'Promotes healthy exchanges of ideas in the classroom',
                'Structures teaching content to achieve learning objectives',
                'Stimulates student desire to learn more about the subject'
            ],
            'critical_factors' => [
                'Encourages creativity in learning',
                'Fosters teamwork among students',
                'Effectively uses multimedia and tech tools',
                'Provides timely and constructive feedback',
                'Creates a supportive classroom environment'
            ]
        ];

        // Define rating labels in the order they should display (Poor to Outstanding)
        $rating_labels = [
            1 => 'Poor',
            2 => 'Fair',
            3 => 'Satisfactory',
            4 => 'Very Satisfactory',
            5 => 'Outstanding'
        ];
        @endphp

        @foreach ($categories as $category => $questions)
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">{{ ucfirst(str_replace('_', ' ', $category)) }}</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="evaluation-table table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th style="width:40%;">Performance Factor</th>
                                    @foreach($rating_labels as $value => $label)
                                        <th class="text-center">{{ $label }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $index => $question)
                                    <tr>
                                        <td class="align-middle">{{ $question }}</td>
                                        @foreach($rating_labels as $value => $label)
                                            <td class="text-center align-middle">
                                                <input 
                                                    type="radio" 
                                                    name="{{ $category }}[{{ $index }}]" 
                                                    id="{{ $category }}_{{ $index }}_{{ $value }}" 
                                                    value="{{ $value }}" 
                                                    required
                                                >
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0">Comments</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <textarea name="comments" id="comments" rows="5" class="form-control" placeholder="Please provide any additional feedback or comments about the instructor..."></textarea>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
            <a href="{{ route('student.dashboard') }}" class="btn btn-secondary me-md-2">
                <i class="fas fa-arrow-left me-1"></i> Return to Dashboard
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane me-1"></i> Submit Evaluation
            </button>
        </div>
    </form>
</div>
@endsection