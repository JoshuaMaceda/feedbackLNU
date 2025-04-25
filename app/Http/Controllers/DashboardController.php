<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController
{
    public function index()
    {
        $user = Auth::user();
    
        if ($user->role === 'student') {
            return view('student.dashboard', compact('user'));
        } elseif ($user->role === 'teacher') {
            return view('teacher.dashboard', compact('user'));
        } elseif ($user->role === 'admin') {
            return view('admin.dashboard', compact('user'));
        } else {
            abort(404); // Handle unexpected roles
        }
    }

    public function studentDashboard()
    {
    // Sample instructor data (Replace with database query if needed)
        $instructors = [
            (object) ['name' => 'Prof. Juan Dela Cruz', 'course' => 'Math 101', 'course_code' => 'MTH101', 'semester' => 'First Semester', 'image' => 'juan.png'],
            (object) ['name' => 'Dr. Maria Santos', 'course' => 'Physics 201', 'course_code' => 'PHY201', 'semester' => 'Second Semester', 'image' => 'maria.png'],
        ];

        return view('student.dashboard', compact('instructors'));
    }
    
}

