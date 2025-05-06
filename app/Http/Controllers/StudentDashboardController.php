<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Evaluation; // Ensuring the correct model is referenced
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    /**
     * Show the student dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get authenticated student
        $student = Student::where('user_id', Auth::id())->first();
        $enrollments = $student->enrollments()->with('course.teacher')->get(); // Fetch enrollments with course & teacher
        
        $instructors = [];
        $completedEvaluations = 0;
        
        foreach ($enrollments as $enrollment) {
            $course = $enrollment->course;
            $teacher = $course->teacher;
            
            $instructors[$teacher->teacher_id] = [
                'id' => $teacher->teacher_id,
                'title' => $teacher->title,
                'name' => "{$teacher->first_name} {$teacher->last_name}",
                'subject' => $course->course_name,
                'course_code' => $course->course_code,
                'semester' => $course->semester,
                'year' => $course->year,
                'completed' => $enrollment->hasEvaluation(),
            ];
            
            if ($enrollment->hasEvaluation()) {
                $completedEvaluations++;
            }
        }

        // Dynamic Stats
        $instructorsToEvaluate = array_filter($instructors, function ($instructor) {
            return !$instructor['completed']; // Show only instructors who haven't been evaluated
        });        
        $totalInstructors = count($instructors);
        $pendingEvaluations = $totalInstructors - $completedEvaluations;
        // Random color selection for avatars
        $colors = ['red', 'blue', 'green', 'orange', 'purple', 'yellow'];

        $student = Student::where('user_id', Auth::id())->first(); 

        $userName = $student ? "{$student->first_name} {$student->last_name}" : 'Guest';
        
        $completedInstructors = array_filter($instructors, function ($instructor) {
            return $instructor['completed']; // Show only instructors who HAVE been evaluated
        });
        
        return view('student.dashboard', compact('userName','instructors', 'totalInstructors', 'completedEvaluations', 'pendingEvaluations', 'colors', 'instructorsToEvaluate', 'completedInstructors'));
    }
}