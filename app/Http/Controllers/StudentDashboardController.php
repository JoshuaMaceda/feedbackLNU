<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Evaluation; // Replaced Feedback with Evaluation
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        // Get the current authenticated student
        $student = Auth::user();

        // Get instructors for subjects the student is enrolled in
        $teachers = Teacher::whereHas('courses', function ($query) use ($student) {
            $query->whereHas('enrollments', function ($q) use ($student) {
                $q->where('student_id', $student->id);
            });
        })->get();
        
        // Count completed evaluations by the student
        $completedCount = Evaluation::where('evaluator_id', $student->id)
            ->whereIn('teacher_id', $instructors->pluck('id')) // Ensure evaluation is linked to instructor
            ->count();

        // Get unread notifications count for the navbar
        $unreadNotificationsCount = $student->unreadNotifications->count();

        // Get recent notifications for the navbar dropdown
        $notifications = $student->notifications()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Return the view with all required data
        return view('student.dashboard', compact(
            'instructors',
            'completedCount',
            'unreadNotificationsCount',
            'notifications'
        ));
    }
}
