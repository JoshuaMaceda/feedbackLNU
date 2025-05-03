<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Feedback;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Show the feedback form for a specific instructor.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function form($id)
    {
        // For now, we're using hardcoded data as specified
        // When implementing dynamic data, use this:
        /*
        $student = Auth::user();
        $teacher = Teacher::findOrFail($id);
        $course = null;
        
        // Check if the student is enrolled in any of this teacher's courses
        foreach ($student->enrollments as $enrollment) {
            if ($enrollment->course->teacher_id == $teacher->id) {
                $course = $enrollment->course;
                break;
            }
        }
        
        if (!$course) {
            return redirect()->route('instructor.index')
                ->with('error', 'You are not enrolled in any courses with this instructor.');
        }
        
        // Check if student has already submitted feedback
        $hasFeedback = Feedback::where('student_id', $student->id)
            ->where('teacher_id', $teacher->id)
            ->where('course_id', $course->id)
            ->exists();
            
        if ($hasFeedback) {
            return redirect()->route('instructor.index')
                ->with('info', 'You have already submitted feedback for this instructor.');
        }
        
        // Get all instructors for the sidebar
        $enrollments = $student->enrollments;
        $instructors = [];
        $completedEvaluations = 0;
        $colors = ['primary', 'info', 'success', 'warning', 'danger', 'secondary'];
        
        foreach ($enrollments as $enrollment) {
            $c = $enrollment->course;
            $t = $c->teacher;
            
            $instructors[$t->id] = [
                'id' => $t->id,
                'title' => $t->title,
                'name' => $t->name,
                'subject' => $c->subject,
                'course_code' => $c->course_code,
                'semester' => $c->semester,
                'year' => $c->year,
                'completed' => $enrollment->hasFeedback(),
                'color' => $colors[array_rand($colors)],
            ];
            
            if ($enrollment->hasFeedback()) {
                $completedEvaluations++;
            }
        }
        
        $totalInstructors = count($instructors);
        $pendingEvaluations = $totalInstructors - $completedEvaluations;
        
        return view('feedback-form', compact(
            'teacher',
            'course',
            'instructors',
            'instructorId' => $id,
            'totalInstructors',
            'completedEvaluations',
            'pendingEvaluations',
            'colors'
        ));
        */
        
        // Hardcoded data for now
        return view('feedback-form', ['instructorId' => $id]);
    }

    /**
     * Submit the feedback form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // For now, we're not implementing real functionality
        // When implementing dynamic data, use this:
        /*
        $request->validate([
            'instructor_id' => 'required|exists:teachers,id',
            'course_id' => 'required|exists:courses,id',
            'q1' => 'required|integer|between:1,5',
            'q2' => 'required|integer|between:1,5',
            'q3' => 'required|integer|between:1,5',
            'q4' => 'required|integer|between:1,5',
            'q5' => 'required|integer|between:1,5',
            'q6' => 'required|integer|between:1,5',
            'comments' => 'nullable|string|max:1000',
        ]);
        
        $student = Auth::user();
        $teacher = Teacher::find($request->instructor_id);
        $course = Course::find($request->course_id);
        
        // Check if student has already submitted feedback
        $existingFeedback = Feedback::where('student_id', $student->id)
            ->where('teacher_id', $teacher->id)
            ->where('course_id', $course->id)
            ->first();
            
        if ($existingFeedback) {
            return redirect()->route('instructor.index')
                ->with('info', 'You have already submitted feedback for this instructor.');
        }
        
        // Calculate ratings
        $teachingEffectiveness = round(($request->q1 + $request->q2 + $request->q3) / 3, 1);
        $courseContent = round(($request->q4 + $request->q5) / 2, 1);
        $overallRating = $request->q6;
        
        // Create feedback record
        Feedback::create([
            'student_id' => $student->id,
            'teacher_id' => $teacher->id,
            'course_id' => $course->id,
            'semester' => $course->semester,
            'year' => $course->year,
            'teaching_effectiveness' => $teachingEffectiveness,
            'course_content' => $courseContent,
            'overall_rating' => $overallRating,
            'comments' => $request->comments,
            'q1' => $request->q1,
            'q2' => $request->q2,
            'q3' => $request->q3,
            'q4' => $request->q4,
            'q5' => $request->q5,
            'q6' => $request->q6,
            'submitted_at' => now(),
        ]);
        
        return redirect()->route('dashboard')
            ->with('success', 'Thank you! Your feedback has been submitted successfully.');
        */
        
        // Just redirect with success message for now
        return redirect()->route('dashboard')
            ->with('success', 'Thank you! Your feedback has been submitted successfully.');
    }
}