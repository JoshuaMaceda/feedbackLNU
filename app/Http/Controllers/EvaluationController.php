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
        $student = Auth::user();
        $teacher = Teacher::findOrFail($id);
        $course = null;
    
        foreach ($student->enrollments as $enrollment) {
            if ($enrollment->course->teacher_id == $teacher->teacher_id) {
                $course = $enrollment->course;
                break;
            }
        }
    
        if (!$course) {
            return redirect()->route('instructor.index')
                ->with('error', 'You are not enrolled in any courses with this instructor.');
        }
    
        // Fetch all instructors for the sidebar
        $enrollments = $student->enrollments()->with('course.teacher')->get();
        $instructors = [];
    
        foreach ($enrollments as $enrollment) {
            $c = $enrollment->course;
            $t = $c->teacher;
    
            $instructors[] = [
                'id' => $t->teacher_id,
                'title' => $t->title,
                'name' => "{$t->first_name} {$t->last_name}",
                'subject' => $c->course_name,
                'course_code' => $c->course_code,
                'semester' => $c->semester,
                'year' => $c->year
            ];
        }
    
        return view('feedback-form', compact(
            'teacher',
            'course',
            'instructors' // ✅ Ensures `$instructors` is passed
        ));
    }
    

    /**
     * Submit the feedback form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'course_id' => 'required|exists:courses,id',
            'professionalism' => 'required|array',
            'commitment' => 'required|array',
            'knowledge' => 'required|array',
            'independent_learning' => 'required|array',
            'management' => 'required|array',
            'critical_factors' => 'required|array',
            'comments' => 'nullable|string|max:1000'
        ]);

        $student = Auth::user();
        $teacher = Teacher::find($validatedData['teacher_id']);
        $course = Course::find($validatedData['course_id']);

        // Prevent duplicate feedback
        $existingFeedback = FeedbackScore::where('teacher_id', $teacher->id)
            ->where('course_id', $course->id)
            ->where('student_id', $student->id)
            ->exists();

        if ($existingFeedback) {
            return redirect()->route('dashboard')->with('info', 'You have already submitted feedback for this instructor.');
        }

        // Save feedback in the `feedback_scores` table
        Score::create([
            'teacher_id' => $validatedData['teacher_id'],
            'course_id' => $validatedData['course_id'],
            'professionalism' => implode(',', $validatedData['professionalism']),
            'commitment' => implode(',', $validatedData['commitment']),
            'knowledge' => implode(',', $validatedData['knowledge']),
            'independent_learning' => implode(',', $validatedData['independent_learning']),
            'management' => implode(',', $validatedData['management']),
            'critical_factors' => implode(',', $validatedData['critical_factors']),
            'comments' => $validatedData['comments'],
            'submitted_at' => now()
        ]);

            // Get the logged-in user's role
        $userRole = Auth::user()->role;

        // Redirect based on role
        switch ($userRole) {
            case 'student':
                return redirect()->route('student.dashboard')->with('success', 'Feedback submitted successfully!');
            case 'teacher':
                return redirect()->route('teacher.dashboard')->with('success', 'Feedback submitted successfully!');
            case 'supervisor':
                return redirect()->route('supervisor.dashboard')->with('success', 'Feedback submitted successfully!');
            case 'admin':
                return redirect()->route('admin.redirector')->with('success', 'Feedback submitted successfully!');
            default:
                return redirect()->route('dashboard')->with('success', 'Feedback submitted successfully!');
   
        }
    }

}