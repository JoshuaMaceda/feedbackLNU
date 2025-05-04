<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    /**
     * Show the list of instructors.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // For now, we're using hardcoded data as specified
        // When implementing dynamic data, use this:
        /*
        $student = Auth::user();
        $enrollments = $student->enrollments;
        
        $instructors = [];
        $completedEvaluations = 0;
        $colors = ['primary', 'info', 'success', 'warning', 'danger', 'secondary'];
        
        foreach ($enrollments as $enrollment) {
            $course = $enrollment->course;
            $teacher = $course->teacher;
            
            $instructors[$teacher->id] = [
                'id' => $teacher->id,
                'title' => $teacher->title,
                'name' => $teacher->name,
                'subject' => $course->subject,
                'course_code' => $course->course_code,
                'semester' => $course->semester,
                'year' => $course->year,
                'completed' => $enrollment->hasFeedback(),
                'color' => $colors[array_rand($colors)],
            ];
            
            if ($enrollment->hasFeedback()) {
                $completedEvaluations++;
            }
        }
        
        $totalInstructors = count($instructors);
        $pendingEvaluations = $totalInstructors - $completedEvaluations;
        
        return view('instructor-list', compact(
            'instructors', 
            'totalInstructors', 
            'completedEvaluations', 
            'pendingEvaluations',
            'colors'
        ));
        */
        
        // Hardcoded data for now
        return view('instructor-list');
    }
}