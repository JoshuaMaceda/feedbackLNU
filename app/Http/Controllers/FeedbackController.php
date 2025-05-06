<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Student;
use App\Models\Evaluation;
use App\Models\Score;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    /**
     * Show the form for creating a new evaluation.
     *
     * @param  int  $instructor
     * @return \Illuminate\Http\Response
     */
    public function create($instructor)
    {
        // Get the student's info
        $student = Student::where('user_id', Auth::id())->firstOrFail();
        
        // Get the selected instructor data
        $teacher = Teacher::findOrFail($instructor);
        
        // Get courses that this student is taking with this teacher
        $studentCourses = $student->enrollments()
                ->with('course')
                ->whereHas('course', function($query) use ($instructor) {
                    $query->where('teacher_id', $instructor);
                })
                ->get()
                ->pluck('course')
                ->first();
                
        if (!$studentCourses) {
            return redirect()->route('student.dashboard')
                ->with('error', 'You are not enrolled in any courses with this instructor.');
        }
        
        // Check if the student has already evaluated this instructor
        $existingEvaluation = Evaluation::where([
            'evaluator_id' => $student->user_id,
            'teacher_id' => $teacher->teacher_id,
            'course_id' => $studentCourses->id
        ])->first();
        
        if ($existingEvaluation) {
            return redirect()->route('student.dashboard')
                ->with('error', 'You have already evaluated this instructor for this course.');
        }
        
        $instructorData = [
            'id' => $teacher->teacher_id,
            'title' => $teacher->title ?? 'Prof.',
            'name' => "{$teacher->first_name} {$teacher->last_name}",
            'subject' => $studentCourses->course_name ?? 'N/A',
            'course_code' => $studentCourses->course_code ?? 'N/A',
            'semester' => $studentCourses->semester ?? 'N/A',
            'year' => $studentCourses->year ?? 'N/A',
        ];

        $activeInstructorId = $teacher->teacher_id;
        
        // Get all instructors for the sidebar with evaluation status
        $enrollments = $student->enrollments()->with('course.teacher')->get();
        
        $instructors = [];
        $completedInstructors = [];
        $instructorsToEvaluate = [];
        
        foreach ($enrollments as $enrollment) {
            $course = $enrollment->course;
            $teacher = $course->teacher;
            
            // Skip if already processed this teacher for the same course
            if (isset($instructors[$teacher->teacher_id]) && 
                $instructors[$teacher->teacher_id]['course_code'] === $course->course_code) {
                continue;
            }
            
            $hasEvaluated = $this->hasStudentEvaluatedTeacher($student->user_id, $teacher->teacher_id, $course->id);
            
            $instructorInfo = [
                'id' => $teacher->teacher_id,
                'title' => $teacher->title ?? 'Prof.',
                'name' => "{$teacher->first_name} {$teacher->last_name}",
                'subject' => $course->course_name,
                'course_code' => $course->course_code,
                'semester' => $course->semester,
                'year' => $course->year,
                'completed' => $hasEvaluated,
            ];
            
            $instructors[$teacher->teacher_id] = $instructorInfo;
            
            if ($hasEvaluated) {
                $completedInstructors[$teacher->teacher_id] = $instructorInfo;
            } else {
                $instructorsToEvaluate[$teacher->teacher_id] = $instructorInfo;
            }
        }
        
        // Random color selection for avatars
        $colors = ['primary', 'success', 'danger', 'warning', 'info'];
        
        $userName = "{$student->first_name} {$student->last_name}";
        
        return view('student.feedback-form', compact(
            'activeInstructorId',
            'instructorData', 
            'userName', 
            'instructors', 
            'completedInstructors', 
            'instructorsToEvaluate', 
            'colors'
        ));
    }

    /**
     * Check if a student has evaluated an instructor for a specific course
     *
     * @param int $studentId
     * @param int $teacherId
     * @param int $courseId
     * @return bool
     */
    private function hasStudentEvaluatedTeacher($studentId, $teacherId, $courseId)
    {
        return Evaluation::where([
            'evaluator_id' => $studentId,
            'teacher_id' => $teacherId,
            'course_id' => $courseId
        ])->exists();
    }

    /**
     * Store a newly created evaluation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'teacher_id' => 'required',
            'course_id' => 'required',
            'professionalism' => 'required|array',
            'commitment' => 'required|array',
            'knowledge' => 'required|array',
            'independent_learning' => 'required|array',
            'management' => 'required|array',
            'critical_factors' => 'required|array',
        ]);

        try {
            DB::beginTransaction();
            
            // Get student info
            $student = Student::where('user_id', Auth::id())->firstOrFail();
            
            // Check if the student has already evaluated this instructor
            $existingEvaluation = Evaluation::where([
                'evaluator_id' => $student->user_id,
                'teacher_id' => $request->teacher_id,
                'course_id' => $request->course_id
            ])->first();
            
            if ($existingEvaluation) {
                DB::rollBack();
                return redirect()->route('student.dashboard')
                    ->with('error', 'You have already evaluated this instructor for this course.');
            }
            
            // Create Score first
            $scoreData = [
                'teacher_id' => $request->teacher_id,
                'course_id' => $request->course_id,
                'comments' => $request->comments,
                'evaluator_id' => $student->user_id,
            ];
            
            // Convert form values to database format
            $categories = ['professionalism', 'commitment', 'knowledge', 'independent_learning', 'management', 'critical_factors'];
            
            foreach ($categories as $category) {
                $values = $request->input($category);
                // No need to modify values - they are already 1-5 from the form
                $scoreData[$category] = json_encode($values);
            }
            
            // Create the score record
            $score = Score::create($scoreData);
            
            // Create evaluation record
            Evaluation::create([
                'teacher_id' => $request->teacher_id,
                'score_id' => $score->id,
                'evaluator_id' => $student->user_id,
                'evaluation_type' => 'student',
                'course_id' => $request->course_id,
                'school_year' => date('Y') . '-' . (date('Y') + 1),
            ]);
            
            DB::commit();
            
            return redirect()->route('student.dashboard')
                ->with('success', 'Evaluation submitted successfully! Thank you for your feedback.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error submitting evaluation: ' . $e->getMessage());
        }
    }
}