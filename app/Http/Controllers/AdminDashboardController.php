<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.redirector');
    }

    public function redirect(Request $request)
    {
        $role = $request->input('role');

        switch ($role) {
            case 'student':
                return redirect()->route('student.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'supervisor':
                return redirect()->route('supervisor.dashboard');
            default:
                return redirect()->route('admin.redirector'); // Fallback route
        }
    }
}
