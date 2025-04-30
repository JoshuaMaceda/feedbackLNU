<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $request->session()->invalidate(); // ✅ Clears expired sessions when login page is accessed
        $request->session()->regenerateToken(); // ✅ Generates a new CSRF token

        return view('auth.login'); // 🚨 Ensure this view exists!
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole(Auth::user()); // Redirect based on user role
        }

        return back()->withErrors(['username' => 'Invalid credentials.']);
    }

    private function redirectBasedOnRole($user)
    {
        switch ($user->role) {
            case 'student':
                return redirect()->route('student.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'supervisor':
                return redirect()->route('supervisor.dashboard');
            case 'admin':
                return redirect()->route('admin.redirector');
            default:
                return redirect()->route('login'); // Fallback if role isn't recognized
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Redirect to login page
    }

}
