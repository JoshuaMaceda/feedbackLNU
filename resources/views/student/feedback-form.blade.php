@extends('layout', ['userName' => $userName])

@section('sidebar')
    @include('student.dashboard') <!-- This keeps the sidebar content intact -->
@endsection

@section('content')
<div class="container mt-4">
    <h2>Student's Evaluation of Faculty</h2>

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="teacher_id" class="form-label">Teacher ID</label>
            <input type="number" name="teacher_id" id="teacher_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Course ID</label>
            <input type="text" name="course_id" id="course_id" class="form-control" required>
        </div>

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
        @endphp

        @foreach ($categories as $category => $questions)
            <h4 class="mt-4">{{ ucfirst(str_replace('_', ' ', $category)) }}</h4>
            @foreach ($questions as $index => $question)
                <div class="mb-3">
                    <label class="form-label">{{ $question }}</label>
                    <select name="{{ $category }}[]" class="form-select" required>
                        <option value="q{{ $index + 1 }}">Outstanding</option>
                        <option value="q{{ $index + 1 }}">Very Satisfactory</option>
                        <option value="q{{ $index + 1 }}">Satisfactory</option>
                        <option value="q{{ $index + 1 }}">Fair</option>
                        <option value="q{{ $index + 1 }}">Poor</option>
                    </select>
                </div>
            @endforeach
        @endforeach

        <div class="mb-3">
            <label for="comments" class="form-label">Additional Comments</label>
            <textarea name="comments" id="comments" rows="3" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Evaluation</button>
    </form>
</div>
@endsection
